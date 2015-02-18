<div class="team" data-ng-controller="WHTeamController">
  <div>
    <div data-ng-repeat="person in Team">
      <a ng-href="{{ person.path }}"><img ng-src="{{ person.picture }}"></a>
      <div>
        <a ng-href="{{ person.path }}">
          <span data-ng-bind="person.firstName"></span>
          <span data-ng-bind="person.lastName"></span>
        </a>
      </div>
      <div data-ng-bind="person.jobTitle"></div>
      <div data-ng-bind="person.office"></div>
    </div>
  </div>
</div>
