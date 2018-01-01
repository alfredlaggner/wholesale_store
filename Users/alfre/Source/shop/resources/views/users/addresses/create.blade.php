@component('layouts.master')

    @slot('title')
        Add new address - {{ config('app.name') }}
    @endslot

    <div class="row content">

        <div class="col-md-12">
            <!-- Nav tabs -->
            @include('users.tabs')

            <ol class="breadcrumb">
                <li><a href="{{ route('addresses') }}" role="tab">Addresses</a></li>
                <li class="active">Add address</li>
            </ol>

            <h1>Add new address</h1>

            @include('snippets.errors')
            @include('snippets.flash')

            <form method="POST" action="{{ route('addresses.store') }}" accept-charset="UTF-8" role="form">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="control-label required">Type:</label>

                            <label>
                                <input type="radio" name="type" value="delivery"{{ old('type', request()->get('type')) == 'delivery' ? ' checked' : '' }} /> Delivery
                            </label>

                            <label>
                                <input type="radio" name="type" value="billing"{{ old('type', request()->get('type')) == 'billing' ? ' checked' : '' }} /> Billing
                            </label>

                            @include('snippets.errors_first', ['param' => 'type'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label required">Name:</label>

                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" maxlength="255" required />

                            @include('snippets.errors_first', ['param' => 'name'])
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="control-label required">Phone:</label>

                            <input type="text" id="phone" class="form-control" name="phone" value="{{ old('phone') }}" maxlength="255" required />

                            @include('snippets.errors_first', ['param' => 'phone'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('address_1') ? ' has-error' : '' }}">
                            <label for="address-1" class="control-label required">Address:</label>

                            <input type="text" id="address-1" class="form-control" name="address_1" value="{{ old('address_1') }}" maxlength="255" required />

                            @include('snippets.errors_first', ['param' => 'address_1'])
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('address_2') ? ' has-error' : '' }}">
                            <label for="address-2" class="control-label">Address 2:</label>

                            <input type="text" id="address-2" class="form-control" name="address_2" value="{{ old('address_2') }}" maxlength="255" />

                            @include('snippets.errors_first', ['param' => 'address_2'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="control-label required">City:</label>

                            <input type="text" id="city" class="form-control" name="city" value="{{ old('city') }}" maxlength="255" required />

                            @include('snippets.errors_first', ['param' => 'city'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="control-label required">State:</label>

                            <select id="state" class="form-control" name="state" required>
                                <option value="">Select one</option>
                                @foreach (config('custom.states') as $key => $value)
                                    <option value="{{ $key }}"{{ old('state') == $key ? ' selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>

                            @include('snippets.errors_first', ['param' => 'state'])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                            <label for="zipcode" class="control-label required">Postal Code:</label>

                            <input type="text" id="zipcode" class="form-control" name="zipcode" value="{{ old('zipcode') }}" maxlength="10" required />

                            @include('snippets.errors_first', ['param' => 'zipcode'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </div>

            </form>
        </div>

    </div>

@endcomponent