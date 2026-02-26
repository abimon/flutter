@extends('layouts.wedding', ['title' => 'Wedding Call Center Dashboard'])
@section('content')
<div class="" style="height: 100vh; width: 100vw; display: flex; align-items: center; justify-content: center;">
    <div class="container profile-card w-md-75 m-auto">
        <h1>✨ Wedding Call Center</h1>

        <form method="POST" action="{{ route('wedding.call-center') }}" class="mb-4 profile-card">
            @csrf
            <div class="mb-3">
                <label for="phone" class="form-label">Enter your username</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="e.g. Lydia Caleb" value="{{ old('phone', $phone ?? '') }}">
                @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Lookup</button>
        </form>

        @if(isset($assignments))
        @if($assignments && $assignments->count())
        <div class="info">
            <h4>Contacts to call for {{ $phone }}</h4>
            @foreach($assignments as $assign)
            <form method="POST" action="/wedding/updateCallResponse/{{ $assign->id }}">
                @csrf
                <div class="text-start row">
                    <div class="col-md-5 mb-2">
                        <div class="mb-2">
                            <p> {{ $loop->iteration }}.
                                @if($assign->contact_name ==null)
                                <input type="text" name="contact_name" placeholder="Enter contact name..." class="form-control">
                                @else
                                {{ $assign->contact_name }}
                                @endif

                            </p>
                        </div>
                        {{ App\Models\Contribution::where('phone', $assign->contact_phone)->exist()?'Given Already':'Not Given' }}
                        <a href="tel:{{ $assign->contact_phone }}">{{ $assign->contact_phone }}</a>
                    </div>
                    <div class="col-md-7 mb-2">
                        <div class="mb-2">
                            <textarea name="response" class="form-control" placeholder="Enter call response...">{{ $assign->response }}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            @endforeach
        </div>
        @else
        <div class="alert alert-warning">No call assignments found for that number.</div>
        @endif
        @endif

        <a href="{{ route('wedding.index') }}">← Back to Wedding Page</a>
    </div>
</div>
@endsection