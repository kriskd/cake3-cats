<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cat->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cat->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cats'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="cats form large-10 medium-9 columns">
    <?= $this->Form->create($cat); ?>
    <fieldset>
        <legend><?= __('Edit Cat') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('is_alive');
            echo $this->Form->input('weight', ['label' => 'Weight in Ounces']);
            echo $this->Form->input('gender', [
                'options' => $this->Catnip->genders(),
                'empty' => 'Choose one',
            ]);
            echo $this->Form->input('ssn');
            echo $this->Form->input('birth_year');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
