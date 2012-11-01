/**
 * Story Model
 */
itsallagile.Model.Story = Backbone.Model.extend({
    urlRoot: '/api/stories',
    
    defaults: function() {
        return {
            tickets: new itsallagile.Collection.Tickets(),
            content: '',
            points: 0
        };
    },
    
    /**
     * When we get a response from the server, that contains tickets put those into a collection
     */
    parse: function(response) {
        response.tickets = this.get('tickets').reset(response.tickets);       
        return response;
    }
    
});
