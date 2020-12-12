import axios from 'axios'
import { get } from 'lodash'

export default {
    namespaced: true,

    state: {
        tweets: []
    },

    getters: {
        tweets (state) {
            return state.tweets
                .sort((a, b) => b.created_at - a.created_at)
        }
    },

    mutations: {
        PUSH_TWEETS (state, data) {
            state.tweets.push(...data.filter((tweet) => {
                return !state.tweets.map((t) => t.id).includes(tweet.id)
            }))
        },

        SET_LIKES (state, { id, count}) {
            state.tweets = state.tweets.map((t) => {
                // Normal tweet case
                if (t.id === id) {
                    t.likes_count = count
                }

                // Retweet of a quote case
                if (get(t, 'original_tweet.id') === id) {
                    t.original_tweet.likes_count = count
                }

                return t
            })
        }
    },

    actions: {
        async getTweets ({ commit }, url) {
            let response = await axios.get(url)
            commit('PUSH_TWEETS', response.data.data)
            commit('PUSH_LIKES', response.data.meta.likes, {root: true})
            commit('PUSH_RETWEETS', response.data.meta.retweets, {root: true})
            return response
        }
    }
}
