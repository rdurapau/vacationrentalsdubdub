module.exports = (data, meta, status) => {
    return {
        data,
        meta: Object.assign({
            // Default
        }, meta),
        status: status || 'ok',
    }
}