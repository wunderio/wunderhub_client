<div class='team' data-ng-controller="WHTeamController">
  <div>
    <div ng-repeat="person in Team">
      <div ng-bind-html="person.picture">
      </div>
      <div>
        {{person.firstName}} {{person.lastName}}
      </div>
      <div>
        {{person.jobTitle}}
      </div>
      <div>
        {{person.office}}
      </div>
    </div>
  </div>

</div>
