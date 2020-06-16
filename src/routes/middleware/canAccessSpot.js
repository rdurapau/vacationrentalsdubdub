module.exports = (permission) => (req, res, next) => {
    var groupID = (req.params.group_id || req.body.group_id);
    var permissions = req.permissions[groupID];
    if (!permissions) return res.status(401).send('Error 12628: You do not have access to this group');

    if (permissions.includes(permission)) {
        return next();
    } else {
        return res.status(401).send(`Error 12629: You do not have access to group ${groupID} in [${permissions.join(', ')}]`);
    }
}