@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-9">
        <div class="panel">
            <div class="panel-body">
                <div class="text-center"> 
                <h3>{{ __('views.User Search') }}</h3>
                </div>
                <form action="{{ route('users.search') }}" method="POST" autocomplete="off">
                    <div class="form-group row mt-4">
                        <label for="search_name" class="col-md-3 col-form-label">@lang('"Search Name"') <br>@lang('(complete or partial)')</label>

                        @csrf
                        <div class="col-md-7">
                            <input id="search_name" type="text" class="form-control @error('search_name') is-invalid @enderror" name="search_name" value="{{ old('search_name') ?: $search_name }}" autofocus autocomplete="off">

                            @error('search_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nation" class="col-md-3 col-form-label">@lang('"Nation"')<br> @lang('(optional)')</label>

                        <div class="col-md-7">
                            <div id="NationSearch" value="{{  $nation }}"></div>

                            @error('nation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="officer" class="col-md-3 col-form-label">{{ __('Search ILP officers:') }}</label>

                        <div class="col-md-1">
                            <input class="form-control-sm" id="officer" name="officer" value=1 type="checkbox" onClick="c = document.getElementById('officer_petitioner'); c.checked = false;" {{ (old('officer')?: $officer) ? ' checked' : '' }}>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="officer_petitioner" class="col-md-3 col-form-label">{{ __('Search officer-petitioners:') }}</label>

                        <div class="col-md-1">
                            <input class="form-control-sm" id="officer_petitioner" name="officer_petitioner" value=1 type="checkbox" onClick="c = document.getElementById('officer'); c.checked = false;" {{ (old('officer_petitioner')?: $officer_petitioner) ? ' checked' : '' }} >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type='submit' class='btn btn-sm btn-primary btn-static-200'>{{__('some.Search')}}</button>
                        </div>
                    </div>
                </form>
                <script>
                    </script>
                    
                <div class="mt-5">
                    @if($users->isNotEmpty())
                        @if ($recent)
                        <center>
                        <h5>Recent public accounts</h5>
                        </center>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('tables.User Category')}}</th>
                                    <th scope="col">{{ __('tables.Search Name')}}</th>
                                    <th scope="col">{{ __('tables.Nation')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                    @endif
                    
                    @forelse ($users as $i=>$user)
                                <tr>
                                    <td>
                                        {{$user->user_type->title}}
                                    </td>
                                    <td>
                                        <a href="{{ route('users.ideological_profile', $user->active_search_name_hash) }}">
                                        {{ $user->active_search_names->first() ? $user->active_search_names->first()->name : '-'}} 
                                        </a>
                                    </td>
                                    <td>
                                        {{ $user->nation->title }}                                        
                                    </td>
                                </tr>
                    @empty
                        <!--<p>@lang('user.No users found')</p>-->
                    @endforelse
                    
                    @if($users->isNotEmpty())                 
                            </tbody>
                        </table>
                        @if(!$recent)
                        {{ $users->appends(request()->except('_token'))->links() }}
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
        
    <div class="col-md-3">
        @include('blocks.following')
    </div>
        
    </div>
</div>
@endsection

