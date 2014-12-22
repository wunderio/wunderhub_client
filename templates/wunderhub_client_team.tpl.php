<div class='team' data-ng-controller="WHTeamController">
  <div>
    <div data-ng-repeat="person in Team">
      <div data-ng-bind-html="person.picture"></div>
      <div>
        <span data-ng-bind="person.firstName"></span>
        <span data-ng-bind="person.lastName"></span>
      </div>
      <div data-ng-bind="person.jobTitle"></div>
      <div data-ng-bind="person.office"></div>
    </div>
  </div>
</div>
