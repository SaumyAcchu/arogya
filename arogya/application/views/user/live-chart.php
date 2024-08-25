<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?=$page['page']='Live Chart';?> | <?=$this->siteInfo['name'];?></title>
        <?php $this->load->view('include/header'); ?>
    </head>
    <body>
        <!--===========top nav start=======-->
        <?php $this->load->view('include/topbar'); ?>
        <!--===========top nav end===========-->
        <div class="wrapper" id="wrapper">
            <div class="left-container" id="left-container">
                <!--========== Sidebar Start =============-->
                <?php $this->load->view('include/sidebar',$page); ?>
                <!--========== Sidebar End ===============-->
            </div>
            <div class="right-container" id="right-container">
                <div class="container-fluid">
                    <?php $this->load->view('include/page-top',$page); ?>
                    <!--//===============Main Container Start=============//-->
                    <div class="row padding-top">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <span class="panel-title txtupper">
                                        <center>Live Chart For All India Team</center>
                                    </span>
                                </div>
                                <div class="panel-body" style="overflow-x: scroll;">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Serial No.</th>
                                                <th>Required Team</th>
                                                <th>Current Active Member</th>
                                                <th>Required Direct ID</th>
                                                <th>Current Direct ID (Active)</th>
                                                <th class="txtright">Incentive</th>
                                                <!--<th>Payment Status</th>-->
                                                <!-- <th>Bonus</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $down=$this->dbm->rowCount('users',['id>'=>$this->logged['id'],'status'=>1]);
                                            $dir=$this->dbm->rowCount('users',['sponcer_id'=>$this->logged['user_id'],'status'=>1]);
                                             $least=1;
                                            $j=1; $team=0; $i=1; $preTeam=0;
                                            foreach ($level as $kk => $val) {
                                               if($val['level']<=5)
                                                {
                                                    $team=$team+$val['team'];
                                                }else
                                                {
                                                    $team=$team+($val['team']-$preTeam);
                                                } ?>
                                            <tr>
                                                <td><?=$j;?></td>
                                                <td><?=$val['team'];?></td>
                                                <td>
                                                    <?php if($down>=$team)
                                                    {
                                                        echo $val['team'];
                                                    }else
                                                    {
                                                        if($least==1)
                                                        {
                                                            echo $down-$preTeam;
                                                            $least++;
                                                        }else
                                                        {
                                                            echo "-";
                                                        }
                                                    } ?>
                                                </td>
                                                <td><?=$val['direct'];?></td>
                                                <td><?=$dir;?></td>
                                                <td class="txtright"><?=$val['bonus'];?></td>
                                                
                                                
                                                
                                                <!-- <td>Bonus</td> -->
                                            </tr>
                                            <?php $preTeam=$val['team']; $j++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <!--//===============Main Container End=============//-->
                </div>
            </div>
        </div>
        <!--==========Footer Start=============-->
        <?php $this->load->view('include/footer'); ?>
        <!--==========Footer End=============-->   
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
    $('#table1').DataTable();
    } );
    
    $('#datepairExample .date').datepicker({
                      'format': 'yyyy-mm-dd',
                      'autoclose': true
                  });
</script>
<style type="text/css">
    .btn-circle{
    border-radius: 50%;
    }
</style>