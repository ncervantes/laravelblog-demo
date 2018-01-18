<div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">

              @foreach ($archives as $stat)
              <li><a href="/?month={{$stat['month']}}&year={{$stat['year']}}">{{$stat['month'].' '.$stat['year']}}</a></li>
              @endforeach
            </ol>
          </div>