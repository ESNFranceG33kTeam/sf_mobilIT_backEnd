adminModule.controller('notificationController', NotificationController);

NotificationController.$inject = [
    'notificationRequest'
];

function NotificationController(notificationRequest) {
    var ctrl = this;

    ctrl.notifications = [];
    ctrl.notification = {};
    ctrl.sectionsSelected = [];
    ctrl.sections = [];
    ctrl.notificationTypes = {
        "text" : 'Simple text',
        "link" : 'External Link',
        "events" : 'Satellite event',
        "news" : 'Satellite news',
        "partners" : 'Satellite partner'
    };
    ctrl.notificationTypesArray = Object.keys(ctrl.notificationTypes)
            .map(function (key) { return {key: key, value: ctrl.notificationTypes[key]} })
            .sort(function(a,b) { return a.value < b.value; } );

    ctrl.init = init;
    ctrl.getNotifications = getNotifications;
    ctrl.getSections = getSections;
    ctrl.sendNotification = sendNotification;

    function init() {
        ctrl.getNotifications();
        ctrl.getSections();
    }

    function getNotifications() {
        notificationRequest.getNotifications().then(function (data) {
            ctrl.notifications = data;
        });
    }

    function getSections() {
        notificationRequest.getSections().then(function (data) {
            ctrl.sections = data;
        });
    }

    function sendNotification() {
        //console.log(ctrl.notification);
        var sectionsToSend = [];
        angular.forEach(ctrl.sectionsSelected, function (section, key) {
            sectionsToSend.push(section.code_section);
        });
        notificationRequest.sendNotification(
            ctrl.notification,
            sectionsToSend
        ).then(function (data) {
                ctrl.notifications.splice(0, 0, data);
                ctrl.notification = {};
            });
    }
}
