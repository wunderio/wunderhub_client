<div class='team-member' data-ng-controller="WHTeamMemberController">
  <div>
    <div data-ng-bind-html="TeamMember.picture"></div>
    <div>
      <span data-ng-bind="TeamMember.firstName"></span>
      <span data-ng-bind="TeamMember.lastName"></span>
    </div>
    <div data-ng-bind="TeamMember.jobTitle"></div>
    <div data-ng-bind="TeamMember.office"></div>
  </div>
</div>
