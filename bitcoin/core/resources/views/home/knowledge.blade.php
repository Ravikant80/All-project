@extends('layouts.fontEnd')
@section('style')
<style>
.tabs-left {
  border-bottom: none;
  border-right: 1px solid #ddd;
}

.tabs-left>li {
  float: none;
 margin:0px;
  
}

.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
  background:#f90;
  border:none;
  border-radius:0px;
  margin:0px;
}
.nav-tabs>li>a:hover {
    /* margin-right: 2px; */
    line-height: 1.42857143;
    border: 1px solid transparent;
    /* border-radius: 4px 4px 0 0; */
}
.tabs-left>li.active>a::after{content: "";
    position: absolute;
    top: 10px;
    right: -10px;
    border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  
  border-left: 10px solid #f90;
    display: block;
    width: 0;}
    
</style>
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
      position: absolute;
      top: 3px;
      right: 3px;
      font-size: 12px;
      font-weight: 700;
      background-color: #8b949d;
      color: #FFF;
      padding: 12px 19px;
      line-height: 100%;
      border-radius: 2px;
      opacity: 0;
      filter: alpha(opacity=0);
      z-index: 2;
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
@endsection
@section('content')
 <section style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}')" class="breadcrumb-section contact-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $page_title}}</h1>
                </div>
            </div>
        </div>
    </section><!--Header section end-->
    <section class="section-padding about-us-page">
        <div class="container">
         <div class="row">
            <h1>Knowledge Section</h1>
            <div role="tabpanel">
               <div class="col-sm-3">
                  <ul class="nav nav-pills brand-pills nav-stacked" role="tablist">
                     <li role="presentation" class="brand-nav active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">News And Press Release</a></li>
                     <li role="presentation" class="brand-nav"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">How to Cash In/Cash Out</a></li>
                     <li role="presentation" class="brand-nav"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">How to Earn Reward</a></li>
                     <li role="presentation" class="brand-nav"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">FAQ</a></li>
                  </ul>
               </div>
                
               <div class="col-sm-9">
                  <div class="tab-content">
                     <div role="tabpanel" class="tab-pane active" id="tab1">
                        <div class="composs-panel">
                           <div class="composs-panel-title">
                              <strong>Most recent articles</strong>
                           </div>
                           <div class="composs-panel-inner">
                              <div class="composs-blog-list lets-do-1">
                                  @foreach($news as $newsData)
                                 <div class="item">
                                    <div class="item-header">
                                       
                                        <a href="post.html"><img src="{{asset('assets/images/news/'.$newsData->image)}}" alt="" style="height: 200px;
    width: 300px;"></a>
                                    </div>
                                    <div class="item-content">
                                       <h2><a href="{{$newsData->otherlinks}}">{{$newsData->headlines}}</a></h2>
                                       <?php
                                        $updt =$newsData->updated_at;
                                        
                                     
                                       ?>
                                       <span class="item-meta">
                                       <span class="item-meta-item"><i class="fa fa-clock-o"> post_time</i>{{ $newsData->updated_at }}</span>
<!--                                       <a href="post.html#comments" class="item-meta-item"><i class="fa fa-clock-o">chat_bubble_outline</i>35</a>-->
                                       </span>
                                       <p>{{$newsData->story}}</p>
                                       <a href="#" class="img-read-later-button">Read More ..</a>
                                    </div>
                                 </div>
                             
                                  @endforeach
                                    {{ $news->render() }}
                              </div>
                           </div>
                        </div>
                     </div>
                      
                      
                     <div role="tabpanel" class="tab-pane" id="tab2">
                        <p>
                           Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. 
                           Summus brains sit, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris.
                           Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium.
                           Qui animated corpse, cricket bat max brucks terribilem incessu zomby. 
                        </p>
                        <p>
                           The voodoo sacerdos flesh eater, suscitat mortuos comedere 
                           carnem virus. Zonbi tattered for solum oculi eorum defunctis go lum cerebro. Nescio brains an Undead zombies. 
                           Sicut malus putrid voodoo horror. Nigh tofth eliv ingdead.
                        </p>
                     </div>
                     <div role="tabpanel" class="tab-pane" id="tab3">
                        <p>
                           Lorem ipsizzle dolor away amizzle, consectetuer pizzle elizzle. Nullizzle yo velizzle, check it out volutpizzle, quis, gravida vel, yo.
                           Ma nizzle eget tortor. Sizzle eros. My shizz izzle dolizzle gizzle turpis tempizzle fo shizzle mah nizzle fo rizzle, mah home g-dizzle.
                           Maurizzle pellentesque nibh izzle own yo'. Check it out in tortor. Pellentesque fizzle rhoncizzle nisi. 
                        </p>
                        <p>
                           In hac habitasse platea dictumst. Shizzlin dizzle dapibus. You son of a bizzle tellizzle urna, pretizzle fo shizzle mah nizzle fo rizzle, mah home g-dizzle,
                           ghetto ac, check it out vitae, nunc. Shizzlin dizzle suscipizzle. Integizzle sempizzle velit sizzle dizzle.
                        </p>
                     </div>
                     <div role="tabpanel" class="tab-pane" id="tab4">
                        <p>
                           Collaboratively administrate empowered markets via plug-and-play networks. 
                           Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without 
                           revolutionary ROI.
                        </p>
                        <p>
                           Efficiently unleash cross-media information without cross-media value. 
                           Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar 
                           solutions without functional solutions.
                        </p>
                        <p>
                           Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate 
                           one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service 
                           for state of the art customer service.
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </section>
      
@endsection
@section('script')
@endsection

