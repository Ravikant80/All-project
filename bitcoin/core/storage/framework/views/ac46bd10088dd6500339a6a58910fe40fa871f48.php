<?php $__env->startSection('style'); ?>

<style type="text/css">
      h1 {
      margin-left: 15px;
      margin-bottom: 20px;
      }
      @media (min-width: 768px) {
      .brand-pills > li > a {
      border-top-right-radius: 0px;
      border-bottom-right-radius: 0px;
      }
      li.brand-nav.active a:after{
      content: " ";
      display: block;
      width: 0;
      height: 0;
      border-top: 20px solid transparent;
      border-bottom: 20px solid transparent;
      border-left: 9px solid #428bca;
      position: absolute;
      top: 50%;
      margin-top: -20px;
      left: 100%;
      z-index: 2;
      }
      }
      .composs-panel {
      display: block;
      margin-bottom: 48px;
      }
      .composs-panel>.composs-panel-title {
      display: block;
      border-bottom: 2px solid #8b949d;
      cursor: default;
      margin-bottom: 30px;
      }
      .lets-do-1>.item {
      width: 100%;
      margin-left: 0;
      }
      .lets-do-1>.item, .lets-do-2>.item, .lets-do-3>.item, .lets-do-4>.item, .lets-do-5>.item {
      display: block;
      float: left;
      margin-left: 3.846153846153846%;
      }
      .composs-blog-list .item-header {
      display: block;
      float: left;
      width: 32.05128205128205%;
      overflow: hidden;
      position: relative;
      border-radius: 3px;
      }
      .img-read-later-button {
        display: block;
    /* position: absolute; */
    top: 3px;
    right: 3px;
    font-size: 12px;
    font-weight: 700;
    /* background-color: #8b949d; */
    color: #de1818;
    padding: 12px 19px;
    line-height: 100%;
    border-radius: 2px;
    /* opacity: 0; */
    filter: alpha(opacity=0);
    z-index: 10000000000000;
    float: right;
      }
      .item-header img {
      width: 100%;
      }
      .composs-blog-list .item-content {
      display: block;
      margin-left: 35.8974358974359%;
      }
      .composs-blog-list.lets-do-1 .item-content h2 {
      font-size: 21px;
      }
      .composs-blog-list .item-meta {
      display: block;
      margin-bottom: 15px;
      font-size: 14px;
      line-height: 100%;
      }
      .composs-blog-list .item-meta .item-meta-item {
      display: inline-block;
      margin-right: 18px;
      color: #8b949d;
      }
      .composs-blog-list .item-meta .item-meta-item .fa fa-clock-o, .composs-blog-list .item-meta .item-meta-item i.fa {
      padding-right: 8px;
      }
      .composs-panel>.composs-panel-title:not(.composs-panel-title-tabbed)>strong, .composs-panel>.composs-panel-title>strong.active {
        color: #000!important;
        border-color: transparent;
        background-color: #ffffff;
        font-size: 18px;
      }
      .composs-blog-list.lets-do-1>.item:nth-child(n+2) {
      padding-top: 30px;
      margin-top: 30px;
      border-top: 2px solid #f2f2f2;
      }
      a {
      color: #232323;
      }
      li.brand-nav.active a:after {
        content: " ";
        display: block;
        width: 0;
        height: 0;
        border-top: 20px solid transparent;
        border-bottom: 20px solid transparent;
        border-left: 20px solid #337ab7;
        position: absolute;
        top: 50%;
        margin-top: -20px;
        left: 100%;
        z-index: 2;
    }
/*    .nav {
    position: fixed !important;
}*/
.pagination{
    float: right;
}
   </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section style="background-image: url('<?php echo e(asset('assets/images')); ?>/<?php echo e($basic->breadcrumb); ?>')" class="breadcrumb-section contact-bg section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1><?php echo e($page_title); ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="section-padding about-us-page">
    <div class="container">
     <div class="row">
           <div class="col-sm-12">
              <div class="tab-content">
                 <div role="tabpanel" class="tab-pane active" id="tab1">
                    <div class="composs-panel">
                
                    <div class="composs-panel-inner">
                       <div class="composs-blog-list lets-do-1">
                           <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="item">
                             <div class="item-header">
                                
                                 <a href="post.html"><img src="<?php echo e(asset('assets/images/news/'.$newsData->image)); ?>" alt="" style="height: 200px;
width: 300px;"></a>
                             </div>
                             <div class="item-content">
                                <h2><a href="<?php echo e(url('news/'.str_slug($newsData->headlines).'/'.$newsData->news_id)); ?>"><?php echo e($newsData->headlines); ?></a></h2>
                                <?php
                                 $updt = formatDate($newsData->updated_at);
                                 
                                ?>
                                <span class="item-meta">
                                <span class="item-meta-item"><i class="fa fa-clock-o"> post_time</i> <?php echo e($updt); ?></span>
<!--                                       <a href="post.html#comments" class="item-meta-item"><i class="fa fa-clock-o">chat_bubble_outline</i>35</a>-->
                                </span>
                                <p><?php echo e($newsData->story); ?></p>
                               
                             </div>
                          </div>
               
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <a href="<?php echo e(url('news')); ?>" class="img-read-later-button">Back To News.</a>
                       </div>
                    </div>
                 </div>
                 </div>
             
              </div>
           </div>
        </div>
     </div>
</section>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.fontEnd', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>