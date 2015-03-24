<div class="person person--page" data-ng-controller="WHTeamMemberController">
  <div class="person__secondary">
    <h1 class="person__name">
      <span data-ng-bind="TeamMember.firstName"></span>
      <span data-ng-bind="TeamMember.lastName"></span>
    </h1>
    <div data-ng-bind="TeamMember.jobTitle"></div>
    <div data-ng-bind="TeamMember.office"></div>
  </div>
  <div class="person__primary">
    <div class="person__picture">
      <img ng-src="{{ TeamMember.picture }}">
    </div>
  </div>
</div>
