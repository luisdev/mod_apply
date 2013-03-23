<?php

// needs $submit, $items, $name_pattern, $user

if ($submit) {

    echo '<form action="operate_entry.php" method="post">';
    echo '<fieldset>';
    echo '<input type="hidden" name="sesskey" value="'.sesskey().'" />';
    echo '<input type="hidden" name="operate" value="operate" />';

	//
	$align   = right_to_left() ? 'right' : 'left';
	$student = $DB->get_record('user', array('id'=>$submit->user_id));

	if 		($name_pattern=='firstname') $user_name = $student->firstname;
	else if ($name_pattern=='lastname')  $user_name = $student->lastname;
	else								 $user_name = fullname($student); 

	$title = $user_name.' ('.userdate($submit->time_modified, '%Y/%m/%d %H:%M').')';
	if ($submit_ver==0) $title .= ' '.get_string('title_draft','apply');


	echo $OUTPUT->heading($title, 3);
	//
	echo $OUTPUT->box_start('generalbox boxaligncenter boxwidthwide');

	foreach ($items as $item) {
		//get the values
		$params = array('submit_id'=>$submit->id, 'item_id'=>$item->id, 'version'=>$submit_ver);
		$value  = $DB->get_record('apply_value', $params);

		echo $OUTPUT->box_start('apply_print_item');
		if ($item->typ!='pagebreak' and $item->label!=APPLY_NODISP_TAG and $item->label!=APPLY_ADMIN_TAG) {
			if (isset($value->value)) {
				apply_print_item_show_value($item, $value->value);
			}
			else {
				apply_print_item_show_value($item, false);
			}
		}
        else if ($item->label==APPLY_ADMIN_TAG) {
			if (isset($value->value)) {
            	apply_print_item_submit($item, $value->value);
			}
			else {
            	apply_print_item_submit($item, false);
			}
        }
		echo $OUTPUT->box_end();
	}
	require('entry_info.php');

	echo $OUTPUT->box_end();

	//
	require('operate_entry_button.php');

    echo '<input type="hidden" name="submit_id"  value="'.$submit->id.'" />';
    echo '<input type="hidden" name="submit_ver" value="'.$submit->version.'" />';
	echo '</fieldset>';
    echo '</form>';
}

//
else {
	echo $OUTPUT->heading(get_string('no_submit_data', 'apply'), 3);
	require('operate_entry_button.php');
}


<?php

// needs $submit, $items, $name_pattern, $user

echo $back_url;
$back_button = $OUTPUT->single_button($back_url, get_string('back_button', 'apply'));


if ($submit) {
	//
	echo $OUTPUT->box_start('generalbox boxaligncenter boxwidthwide');

	echo '<input type="radio" name="example" value="サンプル" />サンプル';
	echo '<input type="radio" name="example" value="サンプル" checked />サンプル';
	echo '<br />';
	echo '<input type="checkbox" name="example" value="サンプル">サンプル';

	$inputvalue = 'value="'.get_string('operate_entry_button', 'apply').'"';
	$submit_button = '<input name="oprate_values" type="submit" '.$inputvalue.' />';
	$reset_button  = '<input type="reset" value="'.get_string('clear').'" />';

	//
	echo '<div align="center">';
	echo '<table border="0">';
	echo '<tr>';
	echo '<td>'.$back_button.'</td>';
	echo '<td>&nbsp;&nbsp;&nbsp;</td>';
	echo '<td>'.$reset_button.'</td>';
	echo '<td>&nbsp;&nbsp;&nbsp;</td>';
	echo '<td>'.$submit_button.'</td>';
	echo '</tr>';
	echo '</table>';
	echo '</div>';

	echo $OUTPUT->box_end();
}

//
else {
	echo '<div align="center">';
	echo $back_button;
	echo '</div>';
}