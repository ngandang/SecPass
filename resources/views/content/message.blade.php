<div class="m-messenger__messages">
    <div class="m-messenger__message m-messenger__message--in">
        <div class="m-messenger__message-pic">
            <img src="{{ url('storage/avatars/' . $sender->profile->avatar) }}" alt=""/>
        </div>
        <div class="m-messenger__message-body">
            <div class="m-messenger__message-arrow"></div>
            <div class="m-messenger__message-content">
                <div class="m-messenger__message-username">
                    Megan wrote
                </div>
                <div class="m-messenger__message-text">
                    Hi Bob. What time will be the meeting ?
                </div>
            </div>
        </div>
    </div>
    <div class="m-messenger__message m-messenger__message--out">
        <div class="m-messenger__message-body">
            <div class="m-messenger__message-arrow"></div>
            <div class="m-messenger__message-content">
                <div class="m-messenger__message-text">
                    Hi Megan. It's at 2.30PM
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-messenger__seperator"></div>
<div class="m-messenger__form">
    <div class="m-messenger__form-controls">
        <input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
    </div>
    <div class="m-messenger__form-tools">
        <a href="" class="m-messenger__form-attachment">
            <i class="la la-paperclip"></i>
        </a>
    </div>
</div>