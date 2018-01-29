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
