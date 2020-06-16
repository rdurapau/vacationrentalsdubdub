var chai = require('chai');
var chaiHttp = require('chai-http');
var server = require('../src');
var should = chai.should();

chai.use(chaiHttp);

describe('DevOps', () => {
    describe('GET  /api/v1/_healthcheck', () => {
        it('Should return system status', done => {
            chai.request(server)
                .get('/api/v1/_healthcheck')
                .end((err, res) => {
                    res.should.have.status(200);
                    res.should.be.json;
                    res.body.should.be.a('object');
                    res.body.status.should.equal('ok');
                    done();
                });
        });
    });

    describe('GET  /api/v1/_authcheck', () => {
        it('Should check auth status', done => {
            chai.request(server)
                .post('/api/v1/auth/login')
                .send({
                    email: 'anthonybudd@vrww.app',
                    password: 'password'
                })
                .end((err, res) => {

                    chai.request(server)
                        .get('/api/v1/_authcheck')
                        .set({
                            'Authorization': 'Bearer ' + res.body.data.access_token,
                        })
                        .end((err, res) => {
                            res.should.have.status(200);
                            done(err);
                        });
                });
        });

        it('Should reject bad Authorization header', done => {
            chai.request(server)
                .get('/api/v1/_authcheck')
                .set({
                    'Authorization': 'Bearer xx.xx.xx',
                })
                .end((err, res) => {
                    res.should.have.status(401);
                    done(err);
                });
        });
    });

});
