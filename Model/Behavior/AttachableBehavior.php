<?php
App::uses('AttachableException', 'Attachable.Lib/Error/Exception');
App::uses('CakeSession', 'Model/Datasource');
class AttachableBehavior extends ModelBehavior {

/**
 * Initiate Upload behavior
 *
 * @param object $model instance of model
 * @param array $config array of configuration settings.
 * @return void
 */
	public function setup(Model $model, $settings = array()) {
		
		$this->defaults = array(
			// move this shit to global config!!!
			'uploadDir' => WWW_ROOT . 'files' . DS . 'uploads' . DS,
			'field' => 'files',
		);
		
		if (!isset($this->settings[$model->alias])) {
			$this->settings[$model->alias] = $this->defaults;
		}
		$this->settings[$model->alias] = array_merge($this->settings[$model->alias], (array)$settings);
	}

/**
 * Validate files in Attachment model
 *
 * @param Model $model Model instance
 * @param array $options
 * @return boolean
 */
	public function beforeValidate(Model $model, $options = array()) {
		if (empty($model->data['Attachment'])) return true;
		
		$this->attachment = ClassRegistry::init('Attachable.Attachment');
		$this->attachment->updateSettings($this->settings[$model->alias]);
		$this->attachment->set($model->data['Attachment']);
		
		if (!$this->attachment->validates()){
			$validationMsg = $this->attachment->invalidFields();
			$model->invalidate($this->settings[$model->alias]['field'], $validationMsg[ $this->settings[$model->alias]['field'] ]);
			return false;
		}
		
		return true;
	}



/**
 * Before save method. Called before all saves
 *
 * Handles setup of file uploads
 *
 * @param Model $model Model instance
 * @param array $options
 * @return boolean
 */
	public function beforeSave(Model $model, $options = array()) {
		return true;
	}

/**
 * Saves files and assignes them to appropriate model
 * 
 * @param Model $model
 * @param type $created
 * @param type $options
 * @return type
 * @throws AttachableException
 */
	public function afterSave(Model $model, $created, $options = array()) {
		if (empty($model->data['Attachment'])) return true;
		
		$attachments = array();
		
		foreach ($model->data['Attachment']['files'] as $file) {
			$attachment = array(
				'user_id' => CakeSession::read('Auth.User.id'),
				'type' => strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)),
				'title' => pathinfo($file['name'], PATHINFO_FILENAME),
				'item_id' => $model->id,
				'item_type' => $model->alias,
			);
			$attachment['path'] = Inflector::slug($attachment['title']) . microtime() .'.'. $attachment['type'];
			
			// WARNING! Possible to call method from model to move file around...
			if (!move_uploaded_file($file['tmp_name'], $this->settings[$model->alias]['uploadDir'] . $attachment['path'])){
				throw new AttachableException('Unable to move file around!');
			}
			$attachments[] = $attachment;
		}
		
		$this->attachment->create();
		$result = $this->attachment->saveMany($attachments);
		
		return $result;
	}

	public function beforeDelete(Model $model, $cascade = true) {
	}

	public function afterDelete(Model $model) {
	}

	public function attachAttachments(Model $model){
		$model->bindModel(array(
			'hasMany' => array(
				'Attachment' => array(
					'className' => 'Attachable.Attachment',
					'foreignKey' => 'item_id',
					'conditions' => array(
						'Attachment.item_type' => $model->alias,
					)
				)
			)
		));
	}

}