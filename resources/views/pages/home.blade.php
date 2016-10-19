@extends('layouts.app')
@section('title') Home :: @parent @endsection
@section('content')
<div class="row" ng-controller="EstimationCtrl">
    <div class="page-header">
        <h2>Start Estimation</h2>
    </div>
    <div class="col-xs-12">
      <div class="row">
        <div class="col-xs-12">
          <button type="button" class="btn btn-lg btn-primary" title="Click to add a space" ng-click="addSpace()"><i class="fa fa-plus"></i></button>
          <button type="button" class="btn btn-lg btn-info" ng-click="saveEstimation()"><i class="fa fa-save"></i></button>
        </div>
      </div>
      <div class="panel panel-space" ng-repeat="space in spaces">
          <div class="panel-heading">
              <div class="row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" autocompl-space ng-if="spacesLoaded" ng-model="space.name">
                </div>
                <div class="col-sm-1 col-xs-2">
                  <input type="text" class="form-control text-center" ng-model="space.size_x">
                </div>
                <div class="col-sm-1 col-xs-2">
                  <input type="text" class="form-control text-center" ng-model="space.size_y">
                </div>
                <div class="col-sm-2 col-xs-4">
                  <input type="text" readonly class="form-control text-center" value="<% space.size_x * space.size_y %>">
                </div>
                <div class="col-sm-2 col-xs-4">
                  <button type="button" class="btn btn-primary" title="Click to add an item" ng-click="addItem(space)">+</button>
                  <button type="button" class="btn btn-danger" title="Click to delete this space" ng-click="removeSpace(space)">X</button>
                </div>
              </div>
          </div>
          <div class="panel-footer">
              <table class="table">
                  <tbody>
                    <tr class="row" ng-repeat="item in space.items">
                      <td class="col-xs-6 col-sm-offset-1">
                        <select class="form-control" ng-model="item.obj" ng-change="setPrice(item)" ng-options="option.name for option in item_options track by option.id">
                          <!-- <option value="">Please choose an item</option> -->
                        </select>
                      </td>
                      <td class="col-sm-2 col-xs-4"><input type="text" readonly class="form-control text-center" value="$ <% item.price | number : 2 %>"></td>
                      <td class="col-sm-2 col-xs-4"><input type="text" readonly class="form-control text-center" value="$ <% item.price * space.size_x * space.size_y | number : 2 %>"></td>
                      <td class="col-sm-1 col-xs-4 text-right"><button type="button" class="btn btn-sm btn-danger" ng-click="removeItem(space, item)"> X </button></td>
                    </tr>
                  </tbody>
              </table>
          </div>
        </div>
    </div>
</div>
@endsection
