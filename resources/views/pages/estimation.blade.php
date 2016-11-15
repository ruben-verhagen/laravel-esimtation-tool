@extends('layouts.app')
@section('title') Home :: @parent @endsection
@section('content')

<div class="row" ng-controller="EstimationViewCtrl" ng-init="init(<?= $estimation->id?>)">
    <div class="col-xs-12">
      <div class="page-header">
        <div class="row">
          <div class="col-xs-6">
            <button type="button" class="btn btn-lg btn-info" ng-click="save()"><i class="fa fa-save"></i> Save Invoice</button>
          </div>
          <div class="col-xs-6 text-right">
            <h2>Invoice # <% estimation.id %></h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="row">
        <div class="col-sm-6 col-md-8">
          <div class="customer_info">
            <div class="form-group">
              <h3>Customer Details</h3>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Full Name" ng-model="estimation.customer_name">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Phone Number" ng-model="estimation.customer_phone">
            </div>
            <div class="form-group">
              <textarea type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Address" ng-model="estimation.customer_address"></textarea>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="customer_email" name="customer_email"  placeholder="Email Address" ng-model="estimation.customer_email">
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="customer_info">
            <div class="form-group">
              <h3>Additional Contacts</h3>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="email1" name="email1" placeholder="Email Address 1" ng-model="estimation.cc_email1">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="email2" name="email2" placeholder="Email Address 2" ng-model="estimation.cc_email2">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="email3" name="email3" placeholder="Email Address 3" ng-model="estimation.cc_email3">
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-space" ng-repeat="space in estimation.spaces">
          <div class="panel-heading">
              <div class="row">
                <div class="col-xs-8">
                  <input type="text" readonly class="form-control" ng-model="space.name">
                </div>
                <div class="col-sm-3 col-xs-4">
                  <input type="text" readonly class="form-control text-center" value="<% space.size_x * space.size_y %> Sq Ft.">
                </div>
              </div>
          </div>
          <div class="panel-footer">
              <table class="table">
                  <tbody>
                    <tr class="row" ng-repeat="item in space.items">
                      <td class="col-xs-5 col-sm-offset-1"><input type="text" readonly class="form-control" value="<% item.name %>"></td>
                      <td class="col-sm-3 col-xs-4"><input type="text" readonly class="form-control text-center" value="$ <% item.price | number : 2 %>"></td>
                      <td class="col-sm-3 col-xs-4"><input type="text" readonly class="form-control text-center" value="$ <% item.price * space.size_x * space.size_y | number : 2 %>"></td>
                    </tr>
                  </tbody>
              </table>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 text-right">
            <h3>Total: $<% total_price %></h3>
          </div>
        </div>
    </div>
</div>
@endsection
