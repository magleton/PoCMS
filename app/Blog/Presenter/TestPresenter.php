<?php
/**
 * User: macro chen <macro_fengye@163.com>
 * Date: 16-12-12
 * Time: 上午9:03
 */

namespace Blog\Presenter;

use Polymer\Presenter\Presenter;

class TestPresenter extends Presenter
{
    public function fullName()
    {
        return $this->name . ' ' . $this->address;
    }
}