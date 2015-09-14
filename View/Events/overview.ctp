<main id="mainRight" class="mainRightSubpage">

<div class="eventsContainer currentEvents">

  <?php if (count($running_events) > 0): ?>
      <h1><?=__d('event', 'Events currently happening')?></h1>
      <?=$this->element('event_articles', array('events' => $running_events));?>
  <?php endif; ?>

</div>

<div class="eventsContainer futureEvents">

  <?php if (count($future_events) > 0): ?>
      <h1><?=__d('event', 'Future events')?></h1>
      <?=$this->element('event_articles', array('events' => $future_events));?>
  <?php else: ?>
      <p><?=__d('event', 'There are no more events planned in the future.')?></p>
  <?php endif; ?>

</div>

<div class="eventsContainer oldEvents">

  <?php if(!isset($no_older_events)): ?>
      <?=$this->Html->link(__d('event', 'Passed events'), array('controller' => 'events','action'=> 'old_events')); ?>
  <?php endif;?>

</div>

<div class="cleaner"></div>

</main>

<aside id="asideLeft" class="asideLeftSubpage">
<div id="asideLeftTopBg"></div>
<div id="asideLeftContent">
  <div id="asideLeftContentContainer">
    <?php echo $this->Regions->blocks('right4'); ?>
  </div>
</div>

<?php echo $this->element('facebooktiles'); ?>

</aside>
