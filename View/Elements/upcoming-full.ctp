<?php
$events = $this->requestAction(array('plugin'=>'event', 'controller'=>'events', 'action'=>'overview'));

if (count($events) > 0): ?>
    <div id="kalender">
        <h2>Jeugdkalender</h2>

    <?php foreach($events as $event): ?>
        <article class="calItem">
            <a href="<?=$this->Html->url($event['Node']['path'])?>">
                <header class="calItemTitle"><?=$event['Node']['title']?></header>
                <div class="calItemDate"><?=$this->Time->i18nFormat($event['Event']['start_date'], Configure::read('Event.date_time_format'))?></div>

                <div class="calItemImg">
                <?php if(isset($event['LinkedAssets']) && isset($event['LinkedAssets']['FeaturedImage'])): ?>
                    <?=$this->Html->image(str_replace('\\','/',$event['LinkedAssets']['FeaturedImage']['path']))?>
                <?php else: ?>
                    <?php echo $this->Html->image('foto1.jpg', $options = array('alt' => 'Default Kalender Afbeelding Jeugd Wetteren')); ?>
                <?php endif; ?>
                </div>

                <div class="calItemInfo">
                    <div class="calItemInfoOrg"><?=$event['Event']['organiser']?></div>
                    <div class="calItemInfoAge">
                        <?php if(isset($event['Taxonomy']) && count($event['Taxonomy']) > 0): ?>
                            <?php foreach($event['Taxonomy'] as $taxo): ?>
                                <?=$this->Html->link($taxo['Term']['title'], array(
                                    'admin' => false,
                                    'plugin' => 'nodes',
                                    'controller' => 'nodes',
                                    'action' => 'term',
                                    'type' => $taxo['Vocabulary']['alias'],
                                    'slug' => $taxo['Term']['slug']
                                ));?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </article>
    <?php endforeach; ?>

        <a href="#" class="btn"><span></span>Volledige kalender</a>
        <div class="cleaner"></div>
    </div>
<?php endif; ?>