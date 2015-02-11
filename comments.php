<?php $comments = R::findAll( 'comments' , ' ORDER BY date DESC ' ); ?>

<?php if(is_array($comments) && !empty($comments)): ?>

<?php
  $tbl_fields = array('name', 'email', 'comment', 'date', 'user_agent', 'ip_address');

  $tbl = new Table();
  $row = $tbl->AddRow();
  $tbl->SetCellContent( $row, 1, "Name");
  $tbl->SetCellContent( $row, 2, "Email");
  $tbl->SetCellContent( $row, 3, "Comment");
  $tbl->SetCellContent( $row, 4, "Date");
  $tbl->SetCellContent( $row, 5, "User Agent");
  $tbl->SetCellContent( $row, 6, "IP");

  foreach ($comments AS $key => $bean) {
    // print '<pre> '. print_r($comment, true) .'</pre>';
    $row = $tbl->AddRow();

    $i=1;
    foreach ($tbl_fields as $field) {
      $tbl->SetCellContent( $row, $i, $bean->$field);
      $i++;
    }
  }

  print $tbl->PrintTable();
?>
<?php else: ?>
<p>No comments have yet been posted be the first</p>
<?php endif; ?>
