export default {
  KEYS_GLOBAL: {
    // 'APP_NAME'      : APP_NAME,
    // 'COIN_HOLDING'  : 'MGC'
  },

  NO_NAME: 'No Name',

  ACCOUNT_TAB_CONFIG : {
    INFO        : 'info',
    DASHBOARD   : 'dashboard',
    BOUNTIES    : 'bounties',
    REVIEWS     : 'reviews',
    FAVORITES   : 'favorites',
  },
  PAYMENT_TYPE : {
    WITHDRAW : 'withdraw',
    DEPOSIT : 'deposit',
    LINK_BANK : 'link_bank',
  },

  ADD_GAME_BOUNTY         : 'AddGameBounty',

  BOUNTY_CLAIMED          : 'claimed',
  BOUNTY_ACCEPTED         : 'accepted',
  BOUNTY_STARTING         : 'starting', // Gamelancer make request start play.
  BOUNTY_STARTED          : 'started', // Bounty is playing.
  BOUNTY_COMPLETED        : 'completed',
  BOUNTY_CANCELED         : 'canceled',
  BOUNTY_REJECTED         : 'rejected',
  BOUNTY_STOPPING         : 'stopping',
  BOUNTY_STOPPED          : 'stopped',

  BOUNTY_TRIGGER_STARTING   : 'trigger_starting',
  BOUNTY_TRIGGER_STARTED    : 'trigger_started',
  BOUNTY_TRIGGER_COMPLETED  : 'trigger_completed',
  BOUNTY_TRIGGER_REQUESTED_ADD_TIME : 'trigger_requested_add_time',
  BOUNTY_TRIGGER_CONFIRMED_ADD_TIME : 'trigger_confirmed_add_time',
  BOUNTY_TRIGGER_REQUESTED_STOP     : 'trigger_requested_stop',
  BOUNTY_TRIGGER_CONFIRMED_STOP     : 'trigger_confirmed_stop',

  NOTIFICATION_TYPE_CLAIMED_BOUNTY : 'Claimed Bounty',

  BROADCAST_RATING_MODAL            : 'RatingModal',
  BROADCAST_BOUNTY_COUNTER_MODAL    : 'BountyCounterModal',

  TIMES   : [15, 30, 60],
  DONATES : [5, 15, 25],

  CREDIT_CARD_TYPE : {
    CREDIT_CARD : 'credit_card',
    PAYPAL : 'paypal',
    IBAN : 'iban',
  },
}