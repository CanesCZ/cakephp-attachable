<?php
App::uses('AttachableException', 'Attachable.Lib/Error/Exception');
App::uses('Folder', 'Utility');

class Attachment extends Model {
	
	private $settings = array(
		'uploadDir' => null, // updated in construct
		'field' => 'files',
	);
	public $validate = array(
		'files' => array(
			'rule' => 'noUploadError',
		)
	);
	
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		// move this to global config!!!
		$this->settings['uploadDir'] = WWW_ROOT . 'files' . DS . 'uploads' . DS;
	}

/**
 * Checks for any upload error and tries to move file across system
 * so the upload will be successfull
 * 
 * @param array $options
 */
	public function noUploadError($check){
		$errMsg = '';
		foreach ($check['files'] as $file) {
			if ($file['error'] !== 0) {
				$errMsg .= '"'. $file['name'] .'": '. $this->uploadErrors[ $file['error'] ] ." \n";
			}
		}
		return empty($errMsg) ? true : $errMsg;
	}
	
/**
 * Prepares and gathers file info for saving
 * 
 * @param array $options
 */
	public function beforeSave($options = array()){
		print_r($this->data);
		return true;
	}
	
/**
 * Maybe rename file so it corresponds with saved record
 * 
 * @param boolean $created
 * @param array $options
 */
	public function afterSave($created, $options = array()){
		
	}

	
	public function beforeDelete($cascade = true){
		
		$attachment = $this->find('first', array(
			'conditions' => array('Attachment.id' => $this->id),
			'fields' => array('path'),
			'contain' => false
		));
		
		if (unlink($this->settings['uploadDir'] . $attachment['Attachment']['path'])) {
			return true;
		} else {
			return false;
		}
	}
	
	public function updateSettings($settings){
		$this->settings = array_merge($this->settings, $settings);
		$uploadsFolder = new Folder($this->settings['uploadDir'], true);
		
		if (!$uploadsFolder) {
			throw new AttachableException('Unable to create uploads folder');
		}
	}
	
	public $uploadErrors = array(
		UPLOAD_ERR_INI_SIZE => "Server nepřijme tak velký soubor.", 
		UPLOAD_ERR_FORM_SIZE => "Soubor je příliš velký.", 
		UPLOAD_ERR_PARTIAL => "Nepodařilo se nahrát celý soubor.", 
		UPLOAD_ERR_NO_FILE => "Soubor nenalezen.", 
		UPLOAD_ERR_NO_TMP_DIR => "Chybí složka pro dočasné soubory.", 
		UPLOAD_ERR_CANT_WRITE => "Nelze zapisovat na disk.", 
		UPLOAD_ERR_EXTENSION => "Neplatná přípona souboru.", 
	);

}
