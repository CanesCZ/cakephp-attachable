<div class="row">
	<div class="col-xs-12">
	<?php
	if (!empty($attachment)){
		echo $this->Form->create('Attachment', array(
			'class' => 'form-inline',
			'inputDefaults' => array(
				'div' => array(
					'class' => 'form-group'
				),
				'class' => 'form-control',
				'label' => array(
					'class' => 'sr-only'
				)
			),
			'url' => array(
				'admin' => false,
				'plugin' => 'attachable',
				'controller' => 'attachments',
				'action' => 'edit',
				$attachment['id'],
			)
		));
		echo $this->Form->input('id', array('value' => $attachment['id']));
		echo $this->Form->input('title', array(
			'placeholder' => 'Title',
			'value' => $attachment['title'],
		));
		echo $this->Form->input('desc', array(
			'placeholder' => 'Description',
			'value' => $attachment['desc'],
		));
		echo $this->Form->submit('Submit', array(
			'class' => 'btn btn-default',
			'div' => false
		));
		echo $this->Form->end();

		echo $this->Form->postLink('Delete', array(
			'admin' => false,
			'plugin' => 'attachable',
			'controller' => 'attachments',
			'action' => 'delete',
			$attachment['id'],
		));
	} else { ?>
		<p class="alert alert-danger">
			<?php echo __d('Attachable', 'Incorrect attachment data passed.'); ?>
		</p>
	<?php } ?>
	</div>
</div>