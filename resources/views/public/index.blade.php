@extends('layouts.app')

@section('content')

  <div class="col-md-12">
    <p>
      Voit lisätä uuden paikan klikkaamalla karttaa halutusta kohdasta.
    </p>
  </div>
</div>
</div>

    <div id="map" height="460px" width="100%"></div>
    <div id="form">
      <form method="post" class="form-horizontal">
        {{csrf_field()}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div><br />
        @endif
        @if (\Session::has('success'))
          <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
          </div><br />
        @endif

        <div class="form-group">
          <label class="control-label col-sm-3" for="title">Paikan nimi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="title">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="description">Kuvaus</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="description">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="open_hours">Aukioloajat</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="open_hours">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">Suosikki</label>
          <div class="col-sm-9">
            <label class="radio-inline"><input type="radio" value="1" name="favorite">Kyllä</label>
            <label class="radio-inline"><input type="radio" value="0" name="favorite">Ei</label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-default submit">Tallenna</button>
          </div>
        </div>
      </form>
    </div>

    <div id="message">Jes, paikka tallennettu!</div>
    <!-- Modal for update -->
    {{-- <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog"> --}}
        <!-- Modal content-->
        {{-- @foreach ($places as $place)
          <!-- TODO: able editing -->
          @if ($place->id == 10) --}}
            {{-- <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Päivitä paikka</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" role="form" method="post">
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="title">Paikan nimi</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="title">
                      <input type="hidden" class="form-control" name="id" value="{{$place->id}}">
                      <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="description">Kuvaus</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="description" value="{{$place->description}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="open_hours">Aukioloajat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="open_hours" value="{{$place->open_hours}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="lat">Leveysaste</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lat" value="{{$place->lat}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="lng">Pituusaste</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lng" value="{{$place->lng}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3">Suosikki</label>
                    <div class="col-sm-9">
                      <label class="radio-inline"><input type="radio" value="1" @if($place->favorite=='1')checked="checked" @endif name="favorite">Kyllä</label>
                        <label class="radio-inline"><input type="radio" value="0" @if($place->favorite=='0')checked="checked" @endif name="favorite">Ei</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-default update">Päivitä</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div> --}}
          {{-- @endif
        @endforeach --}}

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <ul class="list-group allPlaces">
            <li class="list-group-item head">Paikat</li>
            <!-- List of places comes here -->
          </ul>
        </div>
        <div class="col-md-4">
          <div class="input-group">
            <input type="text" class="form-control" id="search" name="search" placeholder="Hae paikkaa nimellä"></input>
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Paikan nimi</th>
                <th>Aukioloajat</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="col-md-4">
          <ul class="list-group allKeywords">
            <li class="list-group-item head">Tägit</li>
            <!-- List of keywords comes here -->
          </ul>
        </div>
      </div>
    </div>




  @endsection

  @section('css')
  @endsection
  @section('script')
  @endsection
