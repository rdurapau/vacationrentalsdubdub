const chai = require('chai');
const chaiHttp = require('chai-http');
const server = require('../src');
const should = chai.should();
const faker = require('faker');

chai.use(chaiHttp);

var PASSWORD_RESET_KEY = 'h8tj5m331qoftsaswcqv6r';


describe('Auth', () => {

    /**
     * POST  api/v1/auth/login
     * 
     */
    describe('POST /api/v1/auth/login', () => {
        it('Should return auth access token', done => {
            chai.request(server)
                .post('/api/v1/auth/login')
                .send({
                    email: 'anthonybudd@vrww.app',
                    password: 'password'
                })
                .end((err, res) => {
                    res.should.have.status(200);
                    res.should.be.json;
                    res.body.data.should.be.a('object');
                    res.body.data.should.have.property('access_token');
                    done(err);
                });
        });

        it('Should reject absent password', done => {
            chai.request(server)
                .post('/api/v1/auth/login')
                .send({
                    email: 'anthonybudd@vrww.app',
                    // password:   'BAD_PASSWORD'
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });

        it('Should reject wrong password', done => {
            chai.request(server)
                .post('/api/v1/auth/login')
                .send({
                    email: 'anthonybudd@vrww.app',
                    password: 'BAD_PASSWORD'
                })
                .end((err, res) => {
                    res.should.have.status(401);
                    done(err);
                });
        });
    });


    /**
     * POST  api/v1/auth/sign-up
     * 
     */
    describe('POST /api/v1/auth/sign-up', () => {

        // Can't test, requires h_token
        //
        // it('Should create a new user', done => {
        //     chai.request(server)
        //         .post('/api/v1/auth/sign-up')
        //         .send({
        //             email: faker.internet.email(),
        //             password: 'password',
        //             first_name: faker.name.firstName(),
        //             last_name: faker.name.lastName(),
        //             restaurant_name: faker.company.bsBuzz(),
        //             tos: '2020-03-20'
        //             h_token: 'xxxxxxxxxxxxxxxxxx'
        //         })
        //         .end((err, res) => {
        //             res.should.have.status(200);
        //             res.should.be.json;
        //             res.body.data.should.be.a('object');
        //             res.body.data.should.have.property('access_token');
        //             done(err);
        //         });
        // });

        it('Should reject missing data', done => {
            chai.request(server)
                .post('/api/v1/auth/sign-up')
                .send({
                    email: faker.internet.email(),
                    tos: '2020-03-20'
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });

        it('Should reject bad email', done => {
            chai.request(server)
                .post('/api/v1/auth/sign-up')
                .send({
                    email: 'anthonybudd@',
                    password: 'password',
                    first_name: faker.name.firstName(),
                    last_name: faker.name.lastName(),
                    tos: '2020-03-20'
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });

        it('Should login if correct email and password', done => {
            chai.request(server)
                .post('/api/v1/auth/sign-up')
                .send({
                    email: 'anthonybudd@vrww.app',
                    password: 'password',
                })
                .end((err, res) => {
                    res.should.have.status(200);
                    res.should.be.json;
                    res.body.data.should.be.a('object');
                    res.body.data.should.have.property('access_token');
                    done(err);
                });
        });

        it('Should reject taken email', done => {
            chai.request(server)
                .post('/api/v1/auth/sign-up')
                .send({
                    email: 'anthonybudd@vrww.app',
                    password: 'foobar12345',
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });

        it('Should reject no TOS', done => {
            chai.request(server)
                .post('/api/v1/auth/sign-up')
                .send({
                    email: faker.internet.email(),
                    password: 'password',
                    first_name: faker.name.firstName(),
                    last_name: faker.name.lastName(),
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });

        it('Should reject bad password', done => {
            chai.request(server)
                .post('/api/v1/auth/sign-up')
                .send({
                    email: faker.internet.email(),
                    password: '12345',
                    first_name: faker.name.firstName(),
                    last_name: faker.name.lastName(),
                    restaurant_name: faker.company.bsBuzz()
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });
    });


    /**
     * POST  api/v1/auth/forgot
     * 
     */
    describe('POST /api/v1/auth/forgot', () => {
        it('Should send reset password email', done => {
            chai.request(server)
                .post('/api/v1/auth/forgot')
                .send({
                    email: 'anthonybudd@vrww.app',
                })
                .end((err, res) => {
                    res.should.have.status(200);
                    res.should.be.json;
                    res.body.data.should.be.a('object');
                    done(err);
                });
        });

        it('Should reject bad email', done => {
            chai.request(server)
                .post('/api/v1/auth/forgot')
                .send({
                    email: 'anthonybudd@',
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });

        it('Should reject non-existing email', done => {
            chai.request(server)
                .post('/api/v1/auth/forgot')
                .send({
                    email: 'johnsmith@example.co.uk',
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });
    });


    /**
     * POST api/v1/auth/reset
     * 
     */
    describe('POST /api/v1/auth/reset', () => {

        it('Should reset password', done => {
            chai.request(server)
                .post('/api/v1/auth/reset')
                .send({
                    email: 'reset_password@vrww.app',
                    password: 'password',
                    password_reset_key: PASSWORD_RESET_KEY
                })
                .end((err, res) => {
                    res.should.have.status(200);
                    res.should.be.json;
                    res.body.data.should.be.a('object');
                    res.body.data.should.have.property('access_token');
                    done(err);
                });
        });

        it('Should reject bad password_reset_key ', done => {
            chai.request(server)
                .post('/api/v1/auth/reset')
                .send({
                    email: 'reset_password@vrww.app',
                    password: 'password',
                    password_reset_key: 'BAD_KEY'
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });

        it('Should reject bad email', done => {
            chai.request(server)
                .post('/api/v1/auth/reset')
                .send({
                    email: 'john.doe@example.co.uk',
                    password: 'password',
                    password_reset_key: PASSWORD_RESET_KEY,
                })
                .end((err, res) => {
                    res.should.have.status(422);
                    done(err);
                });
        });
    });
});
