<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex">
            <h1 class="m-0">{{$page_title??''}}</h1>
            @if(isset($breadcrumb))
            <ol class="breadcrumb float-sm-right ml-3 pt-1">
              @foreach($breadcrumb as $key=>$value)
                @if(isset($value['link']))
                  <li class="breadcrumb-item"><a href="{{$value['link']}}">{{$value['title']}}</a></li>
                @else
                  <li class="breadcrumb-item active">{{$value['title']}}</li>
                @endif
              @endforeach
            </ol>
            @endif
          </div><!-- /.col -->
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                @if(isset($menu))
                  @if(count($menu)==1)
                    <li><a href="{{$menu[0]['link']}}" class="btn btn-pills-violet"><i class="fa fa-plus"></i> {{$menu[0]['title']}}</a></li>
                  @else
                    <div class="dropdown">
                      <button class="btn btn-pills-violet dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-th"></i> Menu
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        @foreach($menu as $key=>$value)
                        <a class="dropdown-item" href="{{$value['link']}}">{{$value['title']}}</a>
                        @endforeach
                      </div>
                    </div>
                  @endif
                @endif
              </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->