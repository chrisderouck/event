<?php // same principle for array with running events as array with future events so simple loop to avoid code duplication
      for($i=0; $i < 1; $i++):?>
    <?php $events = ($i==0)?$running_events : $future_events;?>
    <?php if (count($events) > 0): ?>
        <h1><?=($i==0)? 'Evenementen die bezig zijn' : 'Evenementen in de toekomst'?></h1>
        <?php foreach($events as $event): ?>
            <article>
                <?=$this->Html->link($event['Node']['title'], $event['Node']['path'])?>

                <?=$event['Node']['body']?>

                <?php if(isset($event['LinkedAssets']) && isset($event['LinkedAssets']['FeaturedImage'])): ?>
                    <?=$this->Html->image(str_replace('\\','/',$event['LinkedAssets']['FeaturedImage']['path']))?>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endfor; ?>

<br>
<br>

<?php if(!isset($no_older_events)): ?>
<?=$this->Html->link('Gepasseerde evenementen', array('controller' => 'events','action'=> 'old_events')); ?>
<?php endif;?>