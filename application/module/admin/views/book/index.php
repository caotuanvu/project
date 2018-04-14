<?php
include_once 'toolbar\toolbal.php';
include_once 'submenu\submenu.php';

$valueSort = (isset($this->arrParam['row_order'])) ? $this->arrParam['row_order'] : '';
$SortBy = (isset($this->arrParam['sort_order'])) ? $this->arrParam['sort_order'] : '';

// ORDER BY
$orderbyId          = helper::sortOrderBy('Id', 'id', $valueSort, $SortBy);
$orderbyName        = helper::sortOrderBy('Name', 'name', $valueSort, $SortBy);
$orderbyPicture     = helper::sortOrderBy('Picture', 'picture', $valueSort, $SortBy);
$orderbyStatus      = helper::sortOrderBy('Status', 'status', $valueSort, $SortBy);
$orderbyCategory    = helper::sortOrderBy('Category', 'category', $valueSort, $SortBy);
$orderbyCreated     = helper::sortOrderBy('Created', 'created', $valueSort, $SortBy);
$orderbyOrdering    = helper::sortOrderBy('Ordering', 'ordering', $valueSort, $SortBy);
$orderbyModified    = helper::sortOrderBy('Modified', 'modified', $valueSort, $SortBy);
$orderbyCreateBy    = helper::sortOrderBy('Created By', 'created_by', $valueSort, $SortBy);
$orderbyModifiedBy  = helper::sortOrderBy('Modified By', 'modified_by', $valueSort, $SortBy);
$orderbyPrice       = helper::sortOrderBy('Price', 'price', $valueSort, $SortBy);
$orderbySale_off    = helper::sortOrderBy('Sale off', 'sale_off', $valueSort, $SortBy);
$orderbySpecial     = helper::sortOrderBy('Special', 'special', $valueSort, $SortBy);




//SELECT
$arrOptions = array(2 => '- Select status -', 0 => 'unpublic', 1 => 'public');
$checked = (isset($this->arrParam['filter_select'])) ? $this->arrParam['filter_select'] : 2;
$selectBox = helper::createSelectbox('filter_select', $arrOptions, $checked);



//GROUP_NAME

$arrOptions = $this->category_name;
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

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th width="2%">
                        <input type="checkbox" name="checked-toggle" value="">
                    </th>

                    <th width="2%"><?php echo $orderbyId; ?></th>
                    <th width="10%"><?php echo $orderbyName; ?></th>
                    <th width="8%"><?php echo $orderbyPicture; ?></th>
                    <th width="5%"><?php echo $orderbyStatus; ?></th>
                    <th width="5%"><?php echo $orderbyCreated; ?></th>
                    <th width="5%"><?php echo $orderbyModified; ?></th>
                    <th width="10%"><?php echo $orderbyCreateBy; ?></th>
                    <th width="8%"><?php echo $orderbyModifiedBy; ?></th>
                    <th width="8%"><?php echo $orderbyPrice; ?></th>
                    <th width="8%"><?php echo $orderbySale_off; ?></th>
                    <th width="12%"><?php echo $orderbyCategory; ?></th>
                    <th width="3%"><?php echo $orderbyOrdering; ?></th>
                    <th width="4%"><?php echo $orderbySpecial; ?></th>

                </tr>
                </thead>

                <tbody>

                    <?php

                    if($this->listItems != ''){
                        $xhtml = '';
                        $i = 0;
                        foreach ($this->listItems as $key => $value){
                            $class = ($i % 2 == 0) ? 'odd' : 'even';

                            $linkStatus = URL::setURL('admin', 'book', 'editStatus', array('id' => $value['id'], 'status' => $value['status']));
                            $status = helper::cmsStatus($value['status'], $linkStatus, $value['id']);

                            // format time
                            $created = helper::formatDate($value['created']);
                            $modified = helper::formatDate($value['modified']);
                            $pathPicture =  PUBLIC_FILE . FILE_BOOK . DS . $value['picture'];
                            $linkEditName = URL::setURL('admin', 'book', 'form', array('id' => $value['id']));

                            $xhtml .= '<tr class="'.$class.'">
                            <td width="2%">
                                <input type="checkbox" name="checbox[]" value="' . $value['id'] . '">
                            </td><td width="2%">'.$value['id'].'</td>
                                        <td width="10%"><a href="'.$linkEditName.'">'.$value['name'].'</a></td>
                                        
                                        
                                         <td width="8%"> <img src="'.$pathPicture.'" width="50px" height="auto" alt="" id="img"></td>
                                        <td width="5%">'.$status.'</td>
                                        <td width="8%">'.$created.' </td>
                                        <td width="8%">'.$modified.' </td>
                                        <td width="8%">'.$value['modified_by'].' </td>
                                        <td width="8%">'.$value['created_by'].' </td>
                                       
                                        <td width="8%">'.number_format($value['price']).' vnđ</td>
                                        <td width="8%">'.$value['sale_off'].' vnđ</td>
                                        <td width="12%">'.$value['category'].'</td>
                                        <td width="3%">'.$value['ordering'].'</td>
                                        <td width="4%">'.$value['special'].'</td>
                                      
                                     </tr>';
                            $i++;
                        }
                    }
                    ?>
                    <?php echo $xhtml; ?>
                </tbody>
            </table>
            <div class="hiden">
                <!--                DỰA VÀO VALUE DE SORT ORDER BY-->
                <input type="hidden" name="row_order" value="name">
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
