@extends('../../components/layouts.admin.app')

@section('title', 'View Product - Admin Dashboard')

@section('heading','Users')

@section('content')


<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">User Details</h2>
        <button onclick="history.back()" class="px-4 py-2 bg-blue-800 text-white rounded">Back</button>
    </div>

    <div class="p-6">
        <div class="space-y-4">


            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Street 1</label>
                <p class="text-sm text-gray-900">{{$address->street_address_1}}</p>
            </div>

            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Street 2</label>
                <p class="text-sm text-gray-900">{{$address->street_address_2}}</p>
            </div>

            <div class="">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">City</label>
                <p class="text-sm text-gray-900">{{$address->city}}</p>
            </div>
            <div class="">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">State</label>
                <p class="text-sm text-gray-900">{{$address->state}}</p>
            </div>
            <div class="">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Country</label>
                <p class="text-sm text-gray-900">{{$address->country}}</p>
            </div>


        </div>


    </div>
</div>

@endsection