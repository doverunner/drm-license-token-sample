package com.pallycon.sample.token;

import com.pallycon.sample.exception.PallyConTokenException;

public interface PallyConDrmToken {

    String getDrmType();

    String getSiteId();

    String getUserId();

    String getCId();

    String getPolicy();

    String getSiteKey();

    String getAccessKey();

    String toJsonString() throws PallyConTokenException;

}
