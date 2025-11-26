<?php if (isset($message)): ?>
    <div class="message <?= $message->getType() ?>">
        <?php if ($message->getTitle()): ?>
            <h3><?= $this->e($message->getTitle()) ?></h3>
        <?php endif; ?>
        <p><?= $this->e($message->getText()) ?></p>
    </div>
<?php endif; ?>
