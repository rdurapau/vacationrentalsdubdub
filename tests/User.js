// const chai = require('chai');
// const chaiHttp = require('chai-http');
// const server = require('../src');
// const should = chai.should();

// chai.use(chaiHttp);

// var INVITE_KEY = '89b4983eb38rt493bw9h5d';


// describe('User', () => {

//     /**
//      * GET  /api/v1/user
//      * 
//      */
//     describe('GET  /api/v1/user', () => {

//         it('Should return the user model', done => {
//             chai.request(server)
//                 .get('/api/v1/user')
//                 .end((err, res) => {
//                     res.should.have.status(200);
//                     res.should.be.json;
//                     res.body.data.should.be.a('object');
//                     res.body.data.should.have.property('id');
//                     done();
//                 });
//         });

//         it('Should reject bad access token', done => {
//             chai.request(server)
//                 .get('/api/v1/user')
//                 .set({
//                     'Authorization': 'Bearer ' + 'BAD.TOKEN',
//                     'X-Id-Token': 'BAD.TOKEN',
//                 })
//                 .end((err, res) => {
//                     res.should.have.status(401);
//                     done();
//                 });
//         });
//     });


//     /**
//      * POST /api/v1/user
//      * 
//      */
//     describe('POST /api/v1/user', () => {
//         it('Should update the current user', done => {
//             chai.request(server)
//                 .post('/api/v1/user')
//                 .send({
//                     first_name: 'john',
//                     last_name: 'smith'
//                 })
//                 .end((err, res) => {
//                     res.should.have.status(200);
//                     res.should.be.json;
//                     res.body.data.should.be.a('object');
//                     done();
//                 });
//         });
//     });


//     /**
//      * GET  /api/v1/user/by-invite-key/{invite_key}
//      * 
//      */
//     describe('GET  /api/v1/user/by-invite-key/{invite_key}', () => {

//         it('Should return the user model', done => {
//             chai.request(server)
//                 .get(`/api/v1/user/by-invite-key/${INVITE_KEY}`)
//                 .end((err, res) => {
//                     res.should.have.status(200);
//                     res.should.be.json;
//                     res.body.data.should.be.a('object');
//                     res.body.data.should.have.property('first_name');
//                     res.body.data.should.have.property('last_name');
//                     res.body.data.should.have.property('email');
//                     done();
//                 });
//         });

//         it('Should reject bad invite key', done => {
//             chai.request(server)
//                 .get(`/api/v1/user/by-invite-key/BAD_INVITE_KEY`)
//                 .end((err, res) => {
//                     res.should.have.status(401);
//                     done();
//                 });
//         });
//     });


//     /**
//      * POST /api/v1/user/update-password
//      * 
//      */
//     describe('POST /api/v1/user/update-password', () => {
//         it('Should update the current users password', done => {
//             chai.request(server)
//                 .post('/api/v1/user/update-password')
//                 .send({
//                     password: 'password',
//                     new_password: 'newpassword'
//                 })
//                 .end((err, res) => {
//                     res.should.have.status(200);
//                     res.should.be.json;
//                     res.body.data.should.be.a('object');
//                     done();
//                 });
//         });
//     });
// });