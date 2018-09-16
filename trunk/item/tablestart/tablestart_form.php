<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

require_once($CFG->dirroot.'/mod/apply/item/apply_item_form_class.php');

class apply_tablestart_form extends apply_item_form
{
    protected $type = "tablestart";

    public function definition()
	{
		global $OUTPUT;

        $border_styles = array('none'=>'none', 'hidden'=>'hidden', 'solid'=>'solid', 'double'=>'double', 'dashed'=>'dashed', 
                               'dotted'=>'dotted', 'groove'=>'groove', 'ridge'=>'ridge', 'inset'=>'inset', 'outset'=>'outset');

        $item = $this->_customdata['item'];
        $common = $this->_customdata['common'];
        $positionlist = $this->_customdata['positionlist'];
        $position = $this->_customdata['position'];

        $mform =& $this->_form;

        $mform->addElement('header', 'general', get_string($this->type, 'apply'));
        $mform->addElement('text', 'name',  get_string('item_name', 'apply'), array('size'=>APPLY_ITEM_NAME_TEXTBOX_SIZE, 'maxlength'=>255));
        $mform->addElement('text', 'label', get_string('item_label','apply'), array('size'=>APPLY_ITEM_LABEL_TEXTBOX_SIZE,'maxlength'=>255));

        $mform->addElement('select', 'columns', get_string('table_columns', 'apply').'&nbsp;', array_slice(range(0, 20), 1, 20, true));
        $mform->addElement('select', 'border',  get_string('table_border',  'apply').'&nbsp;', range(0, 10));
        $mform->addElement('select', 'border_style',  get_string('table_border_style', 'apply').'&nbsp;', $border_styles);
        $mform->addElement('textarea', 'th_strings', get_string('table_th_strings', 'apply').'&nbsp;', 'wrap="virtual" rows="3" cols="20"');

        parent::definition();
        $this->set_data($item);
    }

    public function get_data()
    {
        if (!$item = parent::get_data()) {
            return false;
        }

        // その他の値を格納する変数
        $item->presentation = $item->columns.APPLY_TABLESTART_SEP.$item->border.APPLY_TABLESTART_SEP.$item->border_style.APPLY_TABLESTART_SEP.$item->th_strings;
        return $item;
    }
}
