<template>
    <div>
        <app-dropdown v-if="!retweeted">
            <template slot="trigger">
                <app-tweet-retweet-action-button
                    :tweet="tweet"
                />

            </template>
            <app-dropdown-item @click.prevent="retweetOrUnRetweet">
                Retweet
            </app-dropdown-item>
            <app-dropdown-item @click.prevent="log">
                Retweet with comment
            </app-dropdown-item>
        </app-dropdown>

        <app-tweet-retweet-action-button v-else :tweet="tweet" @click.prevent="retweetOrUnRetweet"/>
    </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
import AppTweet from '../AppTweet.vue';
import AppTweetRetweetActionButton from './AppTweetRetweetActionButton.vue';
export default {
  components: { AppTweet, AppTweetRetweetActionButton },
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },

        computed: {
            ...mapGetters({
                retweets: 'retweets'
            }),

            retweeted () {
                return this.retweets.includes(this.tweet.id);
            }
        },

        methods: {
            ...mapActions({
                retweetTweet: 'retweetTweet',
                unRetweetTweet: 'unRetweetTweet'
            }),

            retweetOrUnRetweet () {
                if (this.retweeted) {
                    this.unRetweetTweet(this.tweet)
                    return
                }
                this.retweetTweet(this.tweet)
            }
        },
    }
</script>
