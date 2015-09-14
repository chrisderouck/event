<?php
/**
 * Event Activation
 *
 * Activation class for Event plugin.
 *
 * @package  Croogo
 * @author   Thomas Rader <tom.rader@claritymediasolutions.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.claritymediasolutions.com/portfolio/croogo-event-plugin
 */
class EventActivation {

	public function beforeActivation(Controller $controller) {
		return true;
	}

	public function onActivation(Controller $controller) {
        App::uses('CroogoPlugin', 'Extensions.Lib');
        $CroogoPlugin = new CroogoPlugin();

        // Migrate the database
        $CroogoPlugin->migrate('Event');

        // ACL: set ACOs with permissions
        $controller->Croogo->addAco('Event');
        $controller->Croogo->addAco('Event/Events/admin_index');
        $controller->Croogo->addAco('Event/Events/index', array('registered', 'public'));
        $controller->Croogo->addAco('Event/Events/view', array('registered', 'public'));
        $controller->Croogo->addAco('Event/Events/calendar', array('registered', 'public'));
        $controller->Croogo->addAco('Event/Events/upcoming', array('registered', 'public'));
        $controller->Croogo->addAco('Event/Events/overview', array('registered', 'public'));
        $controller->Croogo->addAco('Event/Events/old_events', array('registered', 'public'));

        // Add settings to the system
        $controller->Setting->write('Event.use_hold_my_ticket','no',array('title' => 'Use Hold My Tickets API', 'description' => 'Fill in "yes" if you wish to use the HMT service', 'editable' => 1));
        $controller->Setting->write('Event.hold_my_ticket_api_key','',array('title' => 'Hold My Tickets API Key', 'description' => 'Fill in your HMT API Key if you choose yes above', 'editable' => 1));
        $controller->Setting->write('Event.oldest_year', date('Y'), array('title' => 'Oldest year to display', 'description'=> 'Till what year do we go back in time to show old events?', 'editable' => 1));
        $controller->Setting->write('Event.date_time_format', '%e %B %Y', array('title' => 'Date Time Format', 'description'=> 'How will we show date time?', 'editable' => 1));
        $controller->Setting->write('Event.show_organiser', '1', array('title' => 'Do you want to choose and show an organiser?', 'description'=> 'If you want to choose an organiser, fill in `1`.', 'editable' => 1));

        // Create a block for upcoming events
        $controller->loadModel('Block');
        $result = $controller->Block->save(array(
            'Block' => array(
                'id' => '',
                'region_id' => '4',
                'title' => 'Upcoming events',
                'alias' => 'upcoming-events',
                'body' => '[element:upcoming plugin="Event"]',
                'show_title' => '0',
                'status' => '1',
                'class' => '',
                'element' => ''
            )
        ));
    }

	public function beforeDeactivation(Controller $controller) {
		return true;
	}

	public function onDeactivation(Controller $controller) {
        App::uses('CroogoPlugin', 'Extensions.Lib');
        $CroogoPlugin = new CroogoPlugin();

        // Unmigrate the database, uncomment this if you want to drop the database at deactivation, data will be lost.
        // $CroogoPlugin->unmigrate('Event');

        // Clear ACO
        $controller->Croogo->removeAco('Event');

        // Remove setting variables
        $controller->Setting->deleteKey('Event.use_hold_my_ticket');
        $controller->Setting->deleteKey('Event.hold_my_ticket_api_key');
        $controller->Setting->deleteKey('Event.oldest_year');
        $controller->Setting->deleteKey('Event.date_time_format');
//TODO: add settings time format and date format

        // Remove block for upcoming events
        $controller->loadModel('Block');
        $block = $controller->Block->findByAlias('upcoming-events');

        if($block){
            if(! $controller->Block->delete($block['Block']['id'])) {
                return false;
            }
        }
	}

 }