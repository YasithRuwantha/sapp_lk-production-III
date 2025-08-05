<?php

/**
 * This file is part of the CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeIgniter\Validation;

use Config\Database;
use InvalidArgumentException;

/**
 * Validation Rules.
 */
class CanoRules
{
	//--------------------------------------------------------------------

	/**
	 * Returns true if $str is earlier than $val.
	 *
	 * @param string $str
	 * @param string $val
	 *
	 * @return boolean
	 */
	public function cano_date_earlier(string $str = null, string $val): bool
	{
		return (strtotime($str . " 00:00:00") < strtotime($val . " 00:00:00"));
	}

    //--------------------------------------------------------------------
    
    /**
	 * Returns true if $str is later than $val.
	 *
	 * @param string $str
	 * @param string $val
	 *
	 * @return boolean
	 */
	public function cano_date_later(string $str = null, string $val): bool
	{
		return (strtotime($str . " 00:00:00") > strtotime($val . " 00:00:00"));
	}

	//--------------------------------------------------------------------

	
}
