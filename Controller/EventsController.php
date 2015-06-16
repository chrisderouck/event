<?php
/**
 * Event Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <tom.rader@claritymediasolutions.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.claritymediasolutions.com/portfolio/croogo-event-plugin
 */
class EventsController extends EventAppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    public $name = 'Events';
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
    public $uses = array('Event','Nodes.Node');

    public function beforeFilter(){
    	parent::beforeFilter();

        // still in use for the older queries
    	$this->Event->bindModel(
        	array('belongsTo' => array('Node')),
        	false
       	);

        // loading through node is done for new queries, to gain access to attached assets
        $this->Node->bindModel(
            array('hasOne' => array('Event')),
            false
        );

        if(Configure::read('Assets.installed')){
            Croogo::hookBehavior('Node', 'Assets.LinkedAssets');
        }

        if (CakePlugin::loaded('Taxonomy')) {
            Croogo::hookBehavior('Node', 'Taxonomy.Taxonomizable');
        }
    }

    public function index(){

    }

	public function hmtview($id = -1){
		$event = array();
		if(strtolower(Configure::read('Event.use_hold_my_ticket')) == 'yes'){
			$this->loadModel('Event.HoldMyTicket');
			$event = array('Event'=>get_object_vars($this->HoldMyTicket->getEvent($id)));
			$this->set("event", $event);
		}
	}

    public function calendar(){
    	Configure::write('debug', 0);
		$this->autoLayout = false;

		$events = $this->Event->find('all', array('conditions'=>array('Node.status'=>1)));
		$json = array();
		foreach($events as $event){
				$json[] = array(
					'id'=>$event['Event']['id'],
					'title'=>$event['Node']['title'],
					'start'=>$event['Event']['start_date'],
					'end'=>$event['Event']['end_date'],
					'url'=>'/'.$event['Node']['type'].'/'.$event['Node']['slug']
				);
		}

		if(strtolower(Configure::read('Event.use_hold_my_ticket')) == 'yes'){
			$this->loadModel('Event.HoldMyTicket');
			$events = $this->HoldMyTicket->getEvents();
			//Configure::write('debug', 2);

			if(!empty($events)){
				foreach($events as $event) {

					$allday = (strtotime($event->end) - strtotime($event->start) > 86400);
					if($allday) {
						$end = $event->start;
					} else {
						$end = $event->end;
					}
					$json[] = array(
							'id' => $event->id,
							'title'=>$event->title,
							'start'=>$event->start,
							'end' => $end,
							'allDay' => $allday,
							'url' => '/events/hmtview/'.$event->id,
							'details' => $event->description
					);
				}
			} else {
				$data = array();
			}
		}

		$this->set('json', json_encode($json));
    }

    public function upcoming(){
		$events = $this->Event->find('all', array('conditions'=>array('Node.status'=>1, 'Event.start_date >'=>date('Y-m-d H:i'))));

		$this->autoLayout = false;
		$this->autoRender = false;

        // not an API call from an element
        if (! isset($this->request->params['requested'])) {
            $this->redirect(array('action' => 'overview'));
        }

        return $events;
    }

    public function overview(){
        if(Configure::read('Assets.installed')) {
            $this->Node->contain(
                array(
                    'Event',
                    'AssetsAssetUsage' => 'AssetsAsset',
                    'Taxonomy' => array(
                        'Term',
                        'Vocabulary',
                    ),
                    'User'));
        }else{
            $this->Node->contain(
                array(
                    'Event',
                    'Taxonomy' => array(
                        'Term',
                        'Vocabulary',
                    ),
                    'User'));
        }

        $running_events = $this->Node->find('all', array('conditions'=>array('Node.status'=>1, 'Event.start_date <'=>date('Y-m-d H:i'), 'Event.end_date >'=>date('Y-m-d H:i'))));

        // TODO : Move this containable behavior thing out of controller.
        if(Configure::read('Assets.installed')) {
            $this->Node->contain(
                array(
                    'Event',
                    'AssetsAssetUsage' => 'AssetsAsset',
                    'Taxonomy' => array(
                        'Term',
                        'Vocabulary',
                    ),
                    'User'));
        }else{
            $this->Node->contain(
                array(
                    'Event',
                    'Taxonomy' => array(
                        'Term',
                        'Vocabulary',
                    ),
                    'User'));
        }

        $future_events = $this->Node->find('all', array('conditions'=>array('Node.status'=>1, 'Event.start_date >'=>date('Y-m-d H:i'))));

        // API call from an element
        if (isset($this->request->params['requested'])) {
            return $future_events;
        }

        $this->set('running_events', $running_events);
        $this->set('future_events', $future_events);

        if(Configure::read('Event.oldest_year') >= date('Y')){
            $this->set('no_older_events', true);
        }
    }

    public function old_events($year = null){
        if (!$year){
            $year = date('Y');
        }

        if(Configure::read('Assets.installed')) {
            $this->Node->contain(
                array(
                    'Event',
                    'AssetsAssetUsage' => 'AssetsAsset',
                    'Taxonomy' => array(
                        'Term',
                        'Vocabulary',
                    ),
                    'User'));
        }else{
            $this->Node->contain(
                array(
                    'Event',
                    'Taxonomy' => array(
                        'Term',
                        'Vocabulary',
                    ),
                    'User'));
        }

        $events = $this->Node->find('all', array('conditions'=>array('Node.status'=>1, 'Event.end_date <'=>date('Y-m-d H:i'), 'YEAR(Event.end_date) >' => $year -1)));

        $this->set('year', $year);
        $this->set('events', $events);

        if(Configure::read('Event.oldest_year') == $year){
            $this->set('no_older_events', true);
        }

        if($year == date('Y')){
            // we don't want a button for the next year, only the button to go to current events which we show all the time.
            $this->set('no_newer_events', true);
        }
    }

}