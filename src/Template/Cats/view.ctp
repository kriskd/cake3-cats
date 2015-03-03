<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Cat'), ['action' => 'edit', $cat->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cat'), ['action' => 'delete', $cat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cat->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cats'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cat'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="cats view large-10 medium-9 columns">
    <h2><?= h($cat->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($cat->name) ?></p>
            <h6 class="subheader"><?= __('Gender') ?></h6>
            <p><?= h($cat->gender) ?></p>
            <h6 class="subheader"><?= __('Ssn') ?></h6>
            <p><?= h($cat->ssn) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Weight') ?></h6>
            <p><?= $cat->readable_weight ?></p>
            <h6 class="subheader"><?= __('Birth Year') ?></h6>
            <p><?= $cat->birth_year ?></p>
            <h6 class="subheader"><?= __('Age') ?></h6>
            <p><?= $cat->age ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($cat->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($cat->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Is Alive') ?></h6>
            <p><?= $cat->is_alive ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
