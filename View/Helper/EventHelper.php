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
    }
/**
 * After render callback. Called after the view file is rendered
 * but before the layout has been rendered.
 *
 * @return void
 */
    public function afterRender($viewFile) {
    }
/**
 * Before layout callback. Called before the layout is rendered.
 *
 * @return void
 */
    public function beforeLayout($viewFile) {
    }
/**
 * After layout callback. Called after the layout has rendered.
 *
 * @return void
 */
    public function afterLayout($viewFile) {
    }
/**
 * Called after LayoutHelper::setNode()
 *
 * @return void
 */
    public function afterSetNode() {
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
	        $string = '<div class="event-data">
	        	From: '. $this->Time->i18nFormat($this->Layout->node['Event']['start_date'], Configure::read('Event.date_time_format')) .'<br />
	        	To: '. $this->Time->i18nFormat($this->Layout->node['Event']['end_date'], Configure::read('Event.date_time_format')) . '<br />';

            if (Configure::read('Event.show_organiser')){
                $string .= 'Organiser: '. $this->Layout->node['Event']['organiser'];
            }

	        $string .= '</div>';

            return $string;
        }
    }
/**
 * Called after LayoutHelper::nodeBody()
 *
 * @return string
 */
    public function afterNodeBody() {
    }
/**
 * Called before LayoutHelper::nodeMoreInfo()
 *
 * @return string
 */
    public function beforeNodeMoreInfo() {
    }
/**
 * Called after LayoutHelper::nodeMoreInfo()
 *
 * @return string
 */
    public function afterNodeMoreInfo() {
    }
}
?>