@extends('layout/front_master_layout')
@section('contents')
<style>
   
    .menu{
        min-width: 100%;
        background-color:#f8f8f8;
        margin: 10px;
        text-align:center;
        box-shadow:0px 3px 4px black;
        padding-bottom:15px;
        border:none;

    }
    .content{
        min-width:100%;
        background-color:#f8f8f8;
    }
    .headers{
        height:80px;
    }
    .card{
        margin-top:20px;
        text-align:center;
        background-color:#f8f8f8;
    }
    .select{
        top:15px;
        overflow:hidden;
        position:relative;
    }
    .header-menu{
        min-height:60px;
        background-color:#816263;
        color:white;
        font-family:'Lato-Regular';
    }
    ul{
        list-style:none;
    }
    .dropdowns{
        cursor:pointer;
        display:black;
        font-size:18px;
        position:relative;
        border:1px solid #2d374d;
        transition:all ease 0.5;
        margin-top:10px;
        border-radius:5px;
        min-height:40px;
        line-height:40px;
    }
    .dropdowns:hover{
        background-color:#816263;
        color:white;
    }
    .dropdowns i{
        position:absolute;
        top:12px;
        right:10px;
    }
   .submenuItems{
    display:none;
   }
   .accordion-menu li.active .submenuItems{
    display:block;
   }
   .submenuItems li{
    min-height:30px;
    border:1px solid black;
    font-size:18px;
    border-radius:5px;
   }
   .submenuItems a{
    display:block;
    color:black;
    transition:all 0.2s ease-out;
    padding:6px 6px 6px 20px;
    text-decoration:none;
   }
</style>
    <div class="col-sm-12 container">
        <div class="col-sm-3">
            <div class="col-sm-12 headers"></div>
            <div class="col-sm-12 menu">
                    <div class="row">
                        <div class="header-menu">
                            <h3>Our Products</h3>
                        </div>
                    </div>
                    <ul class="accordion-menu">
                        <li class="link">
                            <div class="dropdowns">
                                Product
                                <i class="glyphicon glyphicon-chevron-down"></i>
                            </div>
                            <ul class="submenuItems">
                                <li><a href="">home</a></li>
                                <li><a href="">home</a></li>
                                <li><a href="">home</a></li>
                            </ul>
                        </li>
                        <li class="link">
                            <div class="dropdowns">
                                Product
                                <i class="glyphicon glyphicon-chevron-down"></i>
                            </div>
                            <ul class="submenuItems">
                                <li><a href="">home</a></li>
                                <li><a href="">home</a></li>
                                <li><a href="">home</a></li>
                            </ul>
                        </li>
                        <li class="link">
                            <div class="dropdowns">
                                Product
                                <i class="glyphicon glyphicon-chevron-down"></i>
                            </div>
                            <ul class="submenuItems">
                                <li><a href="">home</a></li>
                                <li><a href="">home</a></li>
                                <li><a href="">home</a></li>
                            </ul>
                        </li>
                    </ul>
            </div>
            <div class="col-sm-12 menu">
                <div class="row">
                    <div class="header-menu">
                        <h3>Brand</h3>
                    </div>
                    <ul>
                        <li><input type="checkbox"> APPLE</li>
                        <li>enauk</li>
                        <li>papa</li>
                        <li>babu</li>
                        <li>bhaiya</li>
                        <li>mausi</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 menu">
            <div class="row">
                    <div class="header-menu">
                        <h3>Price</h3>
                    </div>
                    <ul>
                        <li>name</li>
                        <li>enauk</li>
                        <li>papa</li>
                        <li>babu</li>
                        <li>bhaiya</li>
                        <li>mausi</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 headers"></div>
        </div>
        <div class="col-sm-9">
        <div class="col-sm-12 headers">
            <div class="col-sm-5"></div>
            <div class="col-sm-5"></div>
            <div class="col-sm-2 select">
                <select name="">
                    <option value="">SORT BY</option>
                    <option value="">Name</option>
                    <option value="">Price</option>
                </select>
            </div>
        </div>
            <div class="col-sm-12">
                <?php for($i=1; $i<=9;$i++){
                    ?>
                    <div class="col-sm-4 card">
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{url('assets/front/images/p1.jpg')}}" alt="" height="300px" class="img-responsive">
                            </div>
                            <div class="col-sm-12">
                                    <h2>hello</h2>
                            </div>
                            <div class="col-sm-12">
                                    <p>description</p>
                            </div>
                            <div class="col-sm-12">
							<a class="cbp-vm-icon cbp-vm-add item_add" href="#">Add to cart</a>
                            </div>
                        </div>
                            <!-- <div class="card">
                            <img src="{{url('assets/front/images/p1.jpg')}}" class="card-img-tops"  alt="...">
                            <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                            </div> -->
                        </div>
                    <?php }?>
            </div>
            <div class="col-sm-12 headers"></div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    var listElements = document.querySelectorAll('.link');
    listElements.forEach(listElement =>{
        listElement.addEventListener('click',() => {
            if(listElement.classList.contains('active')){
                listElement.classList.remove('active');
            }
            else{
                listElements.forEach(listE => {
                    listE.classList.remove('active');
                })
                listElement.classList.toggle('active');
            }
        })
    })
</script>
@endsection