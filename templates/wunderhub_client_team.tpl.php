<div class='team' data-ng-controller="WHTeamController">
  <div>
    <div data-ng-repeat="person in Team">
      <a ng-href={{person.team_page_url}}><div data-ng-bind-html="person.picture"></div></a>
      <div>
        <a ng-href={{person.team_page_url}}>
          <span data-ng-bind="person.firstName"></span>
          <span data-ng-bind="person.lastName"></span>
        </a>
      </div>
      <div data-ng-bind="person.jobTitle"></div>
      <div data-ng-bind="person.office"></div>
    </div>
  </div>
</div>
