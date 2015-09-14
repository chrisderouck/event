<?php
/**
 * Event Helper
 *
 * Event helper for adding event data onto pages.
 *
 * @category Helper
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <tom.rader@claritymediasolutions.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.claritymediasolutions.com/portfolio/croogo-event-plugin
 */
class EventHelper extends AppHelper {
/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
    public $helpers = array(
        'Html',
        'Layout',
        'Time'
    );
/**
 * Before render callback. Called before the view file is rendered.
 *
 * @return void
 */
    public function beforeRender($viewFile) {
        //echo $viewFile;
        //return "<p>beforeRender</p>";
    }
/**
 * After render callback. Called after the view file is rendered
 * but before the layout has been rendered.
 *
 * @return void
 */
    public function afterRender($viewFile) {
       // return "<p>afterRender</p>";

    }
/**
 * Before layout callback. Called before the layout is rendered.
 *
 * @return void
 */
    public function beforeLayout($viewFile) {
       // return "<p>beforeLayout</p>";

    }
/**
 * After layout callback. Called after the layout has rendered.
 *
 * @return void
 */
    public function afterLayout($viewFile) {
      //  return "<p>afterLayout</p>";

    }
/**
 * Called after LayoutHelper::setNode()
 *
 * @return void
 */
    public function afterSetNode() {
     //   return "<p>set node</p>";
    }
/**
 * Called before LayoutHelper::nodeInfo()
 *
 * @return string
 */
    public function beforeNodeInfo() {
    }
/**
 * Called after LayoutHelper::nodeInfo()
 *
 * @return string
 */
    public function afterNodeInfo() {
    }
/**
 * Called before LayoutHelper::nodeBody()
 *
 * @return string
 */
    public function beforeNodeBody() {
        if(count($this->Layout->node['Event']) > 0 && !empty($this->Layout->node['Event']['start_date']) && !empty($this->Layout->node['Event']['end_date'])){
            if($this->request->params['controller'] == 'nodes' && $this->request->params['action'] == 'view') {
                $string = '<div class="event-data">';
                if (date('Y-mm-dd', strtotime($this->Layout->node['Event']['start_date'])) === date('Y-mm-dd', strtotime($this->Layout->node['Event']['end_date']))){
                    $string .=  'Date: '. $this->Time->i18nFormat($this->Layout->node['Event']['start_date'], Configure::read('Event.date_format')) . '<br />
                            Time: '. $this->Time->i18nFormat($this->Layout->node['Event']['start_date'], Configure::read('Event.time_format')) . " - " .
                        $this->Time->i18nFormat($this->Layout->node['Event']['end_date'], Configure::read('Event.time_format')) . '<br />';
                }else{
                    $string .=  'From: '. $this->Time->i18nFormat($this->Layout->node['Event']['start_date'], Configure::read('Event.date_time_format')) .'<br />
                            To: '. $this->Time->i18nFormat($this->Layout->node['Event']['end_date'], Configure::read('Event.date_time_format')) . '<br />';
                }

                if (Configure::read('Event.show_organiser') && isset($this->Layout->node['Event']['organiser'])){
                    $string .= 'Organiser: '. $this->Layout->node['Event']['organiser'];
                }

                $string .= '</div>';

                return $string;
            }else{
                $string = '<div class="event-data">';
                $string .= $this->Time->i18nFormat($this->Layout->node['Event']['start_date'], Configure::read('Event.date_time_format'));
                $string .= '</div>';

                $string .= '<div class="event-image">';
                if(isset($this->Layout->node['LinkedAssets']) && isset($this->Layout->node['LinkedAssets']['FeaturedImage'])) {
                    $string .= $this->Html->image(str_replace('\\', '/', $this->Layout->node['LinkedAssets']['FeaturedImage']['path']));
                }else{
                    $string .= $this->Html->image('default.jpg', $options = array('alt' => 'Default Calendar Image'));
                }

                $string .= '</div>';
            }

            //var_dump($this->Layout->node); exit;
            return $string;
        }
    }
/**
 * Called after LayoutHelper::nodeBody()
 *
 * @return string
 */
    public function afterNodeBody() {
     //   return "<p>afterNodeBody</p>";

    }
/**
 * Called before LayoutHelcalItemper::nodeMoreInfo()
 *
 * @return string
 */
    public function beforeNodeMoreInfo(){
    }
/**
 * Called after LayoutHelper::nodeMoreInfo()
 *
 * @return string
 */
    public function afterNodeMoreInfo() {
    //    return "<p>afterNodeMoreInfo</p>";

    }
}
?>