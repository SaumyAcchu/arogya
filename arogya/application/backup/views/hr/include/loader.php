<div id="overlay" onclick="off()"></div>
  <div class="loader">
     <center>
         <img class="loading-image" src="<?=base_url('assets/images/loader.gif');?>" alt="loading..">
     </center>
  </div>
<style type="text/css">
.loader
{
    display: block;
    width:200px;
    height: 200px;
    position: fixed;
    top: 30%;
    left: 40%;
    text-align:center;
    margin-left: -50px;
    margin-top: -100px;
    z-index:2;
}

#overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5);
    z-index: 2;
    cursor: pointer;
}
</style>