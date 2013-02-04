<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace li3_behaviors\extensions;

use li3_behaviors\extensions\model\Behaviors;

class Model extends \lithium\data\Model {

	protected $_actsAs = array();

	/**
	 * Configures the model for use. This method will set the `Model::$_schema`, `Model::$_meta`,
	 * `Model::$_finders` class attributes, as well as obtain a handle to the configured
	 * persistent storage connection.
	 *
	 * @param array $config Possible options are:
	 *        - `meta`: Meta-information for this model, such as the connection.
	 *        - `finders`: Custom finders for this model.
	 *        - `query`: Default query parameters.
	 *        - `schema`: A `Schema` instance for this model.
	 *        - `classes`: Classes used by this model.
	 */
	public static function config(array $config = array()) {
		if (($class = get_called_class()) === __CLASS__) {
			return;
		}
		return parent::config($config);
	}

	/**
	 * Init default connection options and connects default finders.
	 *
	 * This method will set the `Model::$_schema`, `Model::$_meta`, `Model::$_finders` class
	 * attributes, as well as obtain a handle to the configured persistent storage connection
	 *
	 * Bahavior methods are applied to the model here.
	 *
	 * @param string $class The fully-namespaced class name to initialize.
	 * @return object Returns the initialized model instance.
	 */
	protected static function _init($class) {
		error_log($class);
		parent::_init($class);

		if ($behaviors = static::_object()->_actsAs) {
			Behaviors::apply($class, $behaviors);
		}
	}
}

?>