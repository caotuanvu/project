<?php
include_once 'toolbar\toolbal.php';
include_once 'submenu\submenu.php';

$valueSort = (isset($this->arrParam['row_order'])) ? $this->arrParam['row_order'] : '';
$SortBy = (isset($this->arrParam['sort_order'])) ? $this->arrParam['sort_order'] : '';

// ORDER BY
$orderbyName = helper::sortOrderBy('Username', 'username', $valueSort, $SortBy);
$orderbyStatus = helper::sortOrderBy('Status', 'status', $valueSort, $SortBy);
$orderbyGroup_id = helper::sortOrderBy('Group_name', 'group_id', $valueSort, $SortBy);
$orderbyEmail = helper::sortOrderBy('Email', 'email', $valueSort, $SortBy);
$orderbyFullname = helper::sortOrderBy('FullName', 'fullname', $valueSort, $SortBy);
$orderbyCreated = helper::sortOrderBy('Created', 'created', $valueSort, $SortBy);
$orderbyOrdering = helper::sortOrderBy('Ordering', 'ordering', $valueSort, $SortBy);
$orderbyModified = helper::sortOrderBy('Modified', 'modified', $valueSort, $SortBy);
$orderbyCreateBy = helper::sortOrderBy('Created By', 'created_by', $valueSort, $SortBy);
$orderbyModifiedBy = helper::sortOrderBy('Modified By', 'modified_by', $valueSort, $SortBy);
$orderbyId = helper::sortOrderBy('Id', 'id', $valueSort, $SortBy);

//SELECT
$arrOptions = array(2 => '- Select status -', 0 => 'unpublic', 1 => 'public');
$checked = (isset($this->arrParam['filter_select'])) ? $this->arrParam['filter_select'] : 2;
$selectBox = helper::createSelectbox('filter_select', $arrOptions, $checked);



//GROUP_NAME

$arrOptions = $this->group_name;
$checked  = (isset($this->arrParam['filter_group'])) ? $this->arrParam['filter_group'] : 0;
$selectGroup_name = helper::createSelectbox('filter_group', $arrOptions, $checked);


// EDIT
//      $link    = URL::setURL('admin','group','form',array('id' => ))

// SEARCH
$filter_val = isset($this->arrParam['filter_val']) ? $this->arrParam['filter_val'] : '';



?>
<div class="content_footer">
    <?php
    $message = helper::cmsSession();
    echo $message;
    ?>

    <form action="#" method="post" name="main-form" id="main-form">
        <div class="list_button">
            <table class="tb-left">
                <th class="row">
                    <lable>Filter:</lable>
                    <input type="text" name="filter_val" value="<?php echo $filter_val; ?>">
                </th>
                <th>
                    <input type="button" name="submit-keyword" value="Search"/>
                </th>
                <th>
                    <input type="button" name="submit-clear" value="Clear"/>
                </th>
            </table>
            <table class="tb-right">
                <th>
                    <div id="select_status">
                        <?php echo $selectBox; ?>
                    </div>
                </th>

                <th>
                    <div id="select_status">
                        <?php echo $selectGroup_name; ?>
                    </div>
                </th>
            </table>
        </div>
        <div class="list_title">
            <table>
                <th width="2%">
                    <input type="checkbox" name="checked-toggle" value="">
                </th>

                <th width="10%"><?php echo $orderbyName; ?></th>
                <th width="16%"><?php echo $orderbyFullname; ?></th>
                <th width="19%"><?php echo $orderbyEmail; ?></th>

                <th width="8%"><?php echo $orderbyStatus; ?></th>
                <th width="7%"><?php echo $orderbyOrdering; ?></th>
                <th width="8%"><?php echo $orderbyCreated; ?></th>
                <th width="10%"><?php echo $orderbyCreateBy; ?></th>
                <th width="8%"><?php echo $orderbyModified; ?></th>
                <th width="10%"><?php echo $orderbyModifiedBy; ?></th>
                <th width="8%"><?php echo $orderbyGroup_id; ?></th>
                <th><?php echo $orderbyId; ?></th>

            </table>
        </div>
        <div class="list_content">
            <?php

            $xhtml = '';
            if (!empty($this->listItems)) {
                $i = 0;
                foreach ($this->listItems as $key => $value) {
                    // class
                    $row = ($i % 2 == 0) ? 'odd' : 'even';

                    // AJAX : LINK
                    $linkStatus = URL::setURL('admin', 'user', 'editStatus', array('id' => $value['id'], 'status' => $value['status']));
                    //$linkGroup_acp = URL::setURL('admin','user','editGroupACP',array('id'=> $value['id'],'group_acp'=> $value['group_acp']));

                    $linkEditName = URL::setURL('admin', 'user', 'form', array('id' => $value['id']));


                    // AJAX : STATUS-GROUP_ACP
                    $status = helper::cmsStatus($value['status'], $linkStatus, $value['id']);

                    // format time
                    $created = helper::formatDate($value['created']);
                    $modified = helper::formatDate($value['modified']);

                    $id = $value['id'];
                    $xhtml .= '<table class="' . $row . '">
                            <td width="2%">
                                <input type="checkbox" name="checbox[]" value="' . $id . '">
                            </td>
                             
                            <td width="10%"><a href="' . $linkEditName . '">' . $value['username'] . '</a></td>
                            <td width="16%">' . $value['fullname'] . '</td>
                            <td width="17%">' . $value['email'] . '</td>
                            <td width="5%">' . $status . '</td>
                     
                            <td width="7%" class="order"><input type="text" size="5" value="' . $value['ordering'] . '" name="order[' . $id . ']"></td>
                            <td width="10%">' . $created . '</td>
                            <td width="10%">' . $value['created_by'] . '</td>
                            <td width="8%">' . $modified . '</td>
                            <td width="7%">' . $value['modified_by'] . '</td>
                                  <td width="10%">' . $value['name'] . '</td>
                                   <th>' . $id . '</th>
                          
                        </table>';
                    $i++;
                }
            }
            ?>
            <?php echo $xhtml; ?>

            <div class="hiden">
                <!--                DỰA VÀO VALUE DE SORT ORDER BY-->
                <input type="hidden" name="row_order" value="fullname">
                <input type="hidden" name="sort_order" value="ASC">
                <input type="hidden" name="filter_page" value="1">
            </div>
        </div>
    </form>
    <div class="panigation">
        <?php

        //$link = URL::setURL('admin','group','index');
        echo $this->panigation->showPanigation();
        ?>
    </div>
</div>
