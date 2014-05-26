<?php
/**
 * AttachmentFixture
 *
 */
class AttachmentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'item_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'item_type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'order_no' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'desc' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'path' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'comment_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'downloaded' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'rating' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id_key' => array('column' => 'user_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'user_id' => '1',
			'item_id' => '1',
			'item_type' => 'FORUM',
			'order_no' => '0',
			'title' => 'first file',
			'desc' => null,
			'path' => 'first_file.jpg',
			'type' => 'jpg',
			'comment_count' => '0',
			'downloaded' => '0',
			'rating' => '0',
			'status' => '0',
			'created' => null,
			'modified' => null
		),
		array(
			'id' => '2',
			'user_id' => '1',
			'item_id' => '1',
			'item_type' => 'FORUM',
			'order_no' => '0',
			'title' => 'broken file',
			'desc' => null,
			'path' => 'broken_file.jpg',
			'type' => 'jpg',
			'comment_count' => '0',
			'downloaded' => '0',
			'rating' => '0',
			'status' => '0',
			'created' => null,
			'modified' => null
		),
		array(
			'id' => '3',
			'user_id' => '1',
			'item_id' => '2',
			'item_type' => 'FORUM',
			'order_no' => '0',
			'title' => 'deleted file',
			'desc' => null,
			'path' => 'deleted_file.jpg',
			'type' => 'jpg',
			'comment_count' => '0',
			'downloaded' => '0',
			'rating' => '0',
			'status' => '0',
			'created' => null,
			'modified' => null
		),
	);

}
