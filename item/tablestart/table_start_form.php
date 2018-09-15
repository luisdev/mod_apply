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

class apply_table_start_form extends apply_item_form
{
    protected $type = "table_start";

    public function definition()
	{
		global $OUTPUT;

        $item = $this->_customdata['item'];
        $common = $this->_customdata['common'];
        $positionlist = $this->_customdata['positionlist'];
        $position = $this->_customdata['position'];

        $border_style = array("none", "hidden", "solid", "double", "dashed", "dotted", "groove", "ridge", "inset", "outset");

        $mform =& $this->_form;

        $mform->addElement('header', 'general', get_string($this->type, 'apply'));
        $mform->addElement('text', 'name', get_string('item_name','apply'), array('size'=>APPLY_ITEM_NAME_TEXTBOX_SIZE, 'maxlength'=>255));

        //$label_help = ' '.$OUTPUT->help_icon('item_label','apply');
        $mform->addElement('text', 'label', get_string('item_label','apply'), array('size'=>APPLY_ITEM_LABEL_TEXTBOX_SIZE,'maxlength'=>255));
        //$mform->addElement('select', 'itemwidth', get_string('table_start_width', 'apply').'&nbsp;', array_slice(range(0, 80), 5, 80, true));
        $mform->addElement('select', 'columns', get_string('table_columns', 'apply').'&nbsp;', range(1, 20));
        $mform->addElement('select', 'border',  get_string('table_border',  'apply').'&nbsp;', range(0, 10));
        $mform->addElement('select', 'boder_style', get_string('table_border_style', 'apply').'&nbsp;', $border_style);
        //$mform->addElement('select', 'itemheight', get_string('table_start_height', 'apply').'&nbsp;', array_slice(range(0, 40), 5, 40, true));
        $mform->addElement('textarea', 'th_elements', get_string('table_th_elements', 'apply').'&nbsp;', 'wrap="virtual" rows="3" cols="20"');

        parent::definition();
        $this->set_data($item);
    }

/*
    public function get_data()
    {
        if (!$item = parent::get_data()) {
            return false;
        }

        $item->presentation = $item->itemwidth . '|'. $item->itemheight;
        return $item;
    }
*/
}
