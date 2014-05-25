<?php
App::uses('Attachment', 'Model');
include APP . DS . 'Test'. DS .'Fixture'. DS .'UploadFixture.php';

/**
 * Attachment Test Case
 *
 */
class AttachmentTest extends CakeTestCase {

	
	private $inputs;
	public $fixtures = array(
		'app.attachment'
	);
	
	public function AttachmentTest(){
		$this->inputs = new UploadFixture();
	}
	
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Attachment = ClassRegistry::init('Attachment');
	}
	
/**
 * tests if the upload has not encountered any error
 */
	public function testBrokenUpload(){
		$this->Attachment->set($this->inputs->incompleteUpload);
		
		$this->assertEquals($this->Attachment->validates(), false);
		
		$invalids = $this->Attachment->invalidFields();
		$this->assertEquals(empty($invalids['files']), false);
	}
	
	public function testOkUpload(){
		$this->Attachment->set($this->inputs->okUpload);
		$this->assertEquals($this->Attachment->validates(), true);
	}
	
/**
 * tests if the upload has not encountered any error
 */
	public function testMultipleBrokenUpload(){
		$this->Attachment->set($this->inputs->multipleUploadBroken);
		
		$this->assertEquals($this->Attachment->validates(), false);
		
		$invalids = $this->Attachment->invalidFields();
		print_r($invalids);
		$this->assertEquals(empty($invalids['files']), false);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Attachment);

		parent::tearDown();
	}

}
