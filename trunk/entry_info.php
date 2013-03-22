<?php

if ($submit) {
//	echo $OUTPUT->box_start('boxaligncenter boxwidthwide');
	//
	if ($submit->class!=APPLY_CLASS_DRAFT) {
		if ($submit->acked==APPLY_ACKED_ACCEPT) {
			$acked_str  = get_string('acked_accept', 'apply');
			$acked_link = apply_get_user_link($submit->acked_user, $name_pattern);
			$acked_time = userdate($submit->acked_time);
		}
		else if ($submit->acked==APPLY_ACKED_REJECT) {
			$acked_str  = get_string('acked_reject', 'apply');
			$acked_link = apply_get_user_link($submit->acked_user, $name_pattern);
			$acked_time = userdate($submit->acked_time);

		}
		else if ($submit->acked==APPLY_ACKED_NOTYET) {
			$acked_str  = get_string('acked_notyet', 'apply');
			$acked_link = '-';
			$acked_time = '-';
		}
	}
	else {
		$acked_str  = '-';	// draft
		$acked_link = '-';
		$acked_time = '-';
	}

	//
	if ($submit->class!=APPLY_CLASS_DRAFT) {
		if ($submit->execd==APPLY_EXECD_DONE) {
			$execd_str  = get_string('execd_done', 'apply');
			$execd_link = apply_get_user_link($submit->execd_user, $name_pattern);
			$execd_time = userdate($submit->execd_time);
		}
		else {
			$execd_str  = get_string('execd_notyet', 'apply');
			$execd_link = '-';
			$execd_time = '-';
		}
	}
	else {
		$execd_str  = '-';	// draft
		$execd_link = '-';
		$execd_time = '-';
	}

	echo '<br />';
	echo '<table border="0" class="entry_info">';
	echo '<tr>';
	echo '<td>'.get_string('title_ack', 'apply').': </td>';
	echo '<td>'.$acked_str.'</td>';
	echo '<td>'.$acked_link.'</td>';
	echo '<td>'.$acked_time.'</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>'.get_string('title_exec', 'apply').': </strong></td>';
	echo '<td>'.$execd_str.'</td>';
	echo '<td>'.$execd_link.'</td>';
	echo '<td>'.$execd_time.'</td>';
	echo '</tr>';
	echo '</table>';
	echo '<br />';

	//
//	echo $OUTPUT->box_end();
}